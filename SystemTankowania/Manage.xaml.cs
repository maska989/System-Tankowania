using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;
using System.Data;
using MySql.Data.MySqlClient;

namespace SystemTankowania
{
    /// <summary>
    /// Logika interakcji dla klasy Manage.xaml
    /// </summary>
    public partial class Manage : Window
    {
        int idU;
        string removeitem;
        public Manage(int id)
        {
            InitializeComponent();
            idU = id;
            LoadListView();

                try //przy starcie wczytanie aut jakie posiada użytkownik i wyświetlenie w ComboBox
                {
                String mojePolaczenie = "Server=projekttankowania.cba.pl;Port=3306;Database=maska989;Uid=Maska989;Password=BazaProjekt2;";
                MySqlConnection Polaczenie = new MySqlConnection(mojePolaczenie);
                string ZapytanieSQL = "SELECT idSamochodu, model, marka, nr_rej FROM Samochody s, Uzytkownik u where u.idUzytkownika='" + idU + "' and s.idUzytkownika = u.idUzytkownika;";
                MySqlDataAdapter AdapterSQL = new MySqlDataAdapter();
                AdapterSQL.SelectCommand = new MySqlCommand(ZapytanieSQL, Polaczenie);
                MySqlCommandBuilder builder = new MySqlCommandBuilder(AdapterSQL);
                
                Polaczenie.Open();
                DataSet ds = new DataSet();
                AdapterSQL.Fill(ds, "t");
                Polaczenie.Close();

                pojazdcb.ItemsSource = ds.Tables["t"].DefaultView;
            }
                catch (Exception ex)
                {
                    MessageBox.Show(ex.ToString());
                }
            }

        private void LoadListView() //załadowanie tankowań użytkownika i wyświetlenie w DataGrid
        {
            this.tanklist.ItemsSource = null;
            this.tanklist.Items.Clear();
            String mojePolaczenie = "Server=projekttankowania.cba.pl;Port=3306;Database=maska989;Uid=Maska989;Password=BazaProjekt2;";
            MySqlConnection Polaczenie = new MySqlConnection(mojePolaczenie);
            string ZapytanieSQL = "select idTankowania as 'ID', model as 'Pojazd', nr_rej as 'Nr rejestracyjny', Przebieg, rodzaj as 'Rodzaj', cena as 'Cena', ilosc as 'Ilość', kwota as 'Kwota', miasto as 'Miasto', kom as 'Komentarz' from Tankowania t, Samochody s where t.idUzytkownika='" + idU + "' and t.idSamochodu = s.idSamochodu order by ID ASC;";

            MySqlDataAdapter AdapterSQL = new MySqlDataAdapter();
            AdapterSQL.SelectCommand = new MySqlCommand(ZapytanieSQL, Polaczenie);
            MySqlCommandBuilder builder = new MySqlCommandBuilder(AdapterSQL);

            Polaczenie.Open();
            DataTable dane = new DataTable();
            AdapterSQL.Fill(dane);
            Polaczenie.Close();


            tanklist.ItemsSource = dane.DefaultView;
            tanklist.ColumnWidth = 100;
        }

        private void Window_Closed(object sender, EventArgs e)
        {
            this.Close();
        }


        private void ilosctb_Copy_GotFocus(object sender, RoutedEventArgs e) //po kliknięciu w pole z kosztem automatyczne przeliczenie na podstawie ceny i ilości
        {
            try
            {
                double koszttank = double.Parse(cenatb.Text.Replace(',', '.'), System.Globalization.CultureInfo.InvariantCulture) * double.Parse(ilosctb.Text.Replace(',', '.'), System.Globalization.CultureInfo.InvariantCulture);
                koszttb.Text = koszttank.ToString();
            }
            catch (Exception ex) { MessageBox.Show(ex.Message); }
        }

        private void dodaj_tank_btn_Click(object sender, RoutedEventArgs e) //przycisk dodaj tankowanie
        {
            string cena = cenatb.Text.Replace(".", ",");
            string ilosc = ilosctb.Text.Replace(".", ",");
            string koszt = koszttb.Text.Replace(".", ",");
            try
            {
                String mojePolaczenie = "Server=projekttankowania.cba.pl;Port=3306;Database=maska989;Uid=Maska989;Password=BazaProjekt2;";
                MySqlConnection Polaczenie = new MySqlConnection(mojePolaczenie);

                MySqlCommand command = Polaczenie.CreateCommand();
                command.CommandText = "INSERT INTO Tankowania(cena, rodzaj, ilosc, miasto, kom, idUzytkownika, idSamochodu, Przebieg, Wojewodztwo, kwota) VALUES (@cena, @rodzaj, @ilosc, @miasto, @kom, @idUzytkownika, @idSamochodu, @Przebieg, @Wojewodztwo, @kwota)";
                command.Parameters.Add("@cena", MySqlDbType.Double).Value = Convert.ToDouble(cena);
                command.Parameters.Add("@rodzaj", MySqlDbType.VarChar).Value = rodzajcb.Text;
                command.Parameters.Add("@ilosc", MySqlDbType.Double).Value = Convert.ToDouble(ilosc);
                command.Parameters.Add("@miasto", MySqlDbType.VarChar).Value = miastotb.Text;
                command.Parameters.Add("@kom", MySqlDbType.VarChar).Value = komtb.Text;
                command.Parameters.Add("@idUzytkownika", MySqlDbType.Int64).Value = idU;
                command.Parameters.Add("@idSamochodu", MySqlDbType.Int64).Value = Convert.ToInt64(pojazdcb.SelectedValue.ToString());
                command.Parameters.Add("@Przebieg", MySqlDbType.Int64).Value = Convert.ToInt64(przebiegtb.Text);
                command.Parameters.Add("@Wojewodztwo", MySqlDbType.VarChar).Value = wojcb.Text;
                command.Parameters.Add("@kwota", MySqlDbType.Double).Value = Convert.ToDouble(koszt);

                Polaczenie.Open();
                command.ExecuteNonQuery();
                Polaczenie.Close();
                MessageBox.Show("Pomyślnie dodano nowe tankowanie!", "Sukces");
                LoadListView();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        private void Button_Click(object sender, RoutedEventArgs e) //przycisk usuń tankowanie
        {
            try
            {
                DataRowView dataRowView = (DataRowView)tanklist.SelectedItem;

                if (dataRowView != null)
                {
                    removeitem = dataRowView["ID"].ToString(); //pobranie ID zaznaczonego tankowania


                    MessageBoxResult result = MessageBox.Show(string.Format("Czy chcesz skasować tankowanie o ID {0} ?", removeitem), "Kasowanie tankowania", MessageBoxButton.YesNo);

                    if (result == MessageBoxResult.Yes)
                    {
                        try
                        {
                            String mojePolaczenie = "Server=projekttankowania.cba.pl;Port=3306;Database=maska989;Uid=Maska989;Password=BazaProjekt2;";
                            MySqlConnection Polaczenie = new MySqlConnection(mojePolaczenie);

                            MySqlCommand command = Polaczenie.CreateCommand();
                            command.CommandText = "DELETE FROM Tankowania WHERE idTankowania ='" + removeitem + "';";

                            Polaczenie.Open();
                            command.ExecuteNonQuery();
                            Polaczenie.Close();
                            MessageBox.Show("Pomyślnie skasowano tankowanie!", "Sukces");
                            LoadListView();
                        }
                        catch (Exception ex)
                        {
                            MessageBox.Show(ex.Message);
                        }
                    }
                    else if (result == MessageBoxResult.No)
                    {

                    }
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            };
        }
    }
 }
