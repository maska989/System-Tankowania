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
    /// Logika interakcji dla klasy Cars.xaml
    /// </summary>
    public partial class Cars : Window
    {
        int idU;
        string removeitem;
        public Cars(int id)
        {
            InitializeComponent();
            idU = id;
            LoadGrid();
        }


        private void Button_Click(object sender, RoutedEventArgs e) //przycisk dodaj
        {
            try
            {
                String mojePolaczenie = "Server=projekttankowania.cba.pl;Port=3306;Database=maska989;Uid=Maska989;Password=BazaProjekt2;";
                MySqlConnection Polaczenie = new MySqlConnection(mojePolaczenie);

                MySqlCommand command = Polaczenie.CreateCommand(); //dodanie wpisu do bazy z wprowadzonymi danymi na temat samochodu
                command.CommandText = "INSERT INTO Samochody(idUzytkownika,marka,model,nr_rej,komentarz) VALUES (@idUzytkownika, @marka, @model, @nr_rej, @komentarz)";
                command.Parameters.Add("@idUzytkownika", MySqlDbType.Int64).Value = idU;
                command.Parameters.Add("@marka", MySqlDbType.VarChar).Value = marka_textbox.Text;
                command.Parameters.Add("@model", MySqlDbType.VarChar).Value = model_textbox.Text;
                command.Parameters.Add("@nr_rej", MySqlDbType.VarChar).Value = nr_textbox.Text;
                command.Parameters.Add("@komentarz", MySqlDbType.VarChar).Value = kom_textbox.Text;

                Polaczenie.Open();
                command.ExecuteNonQuery();
                Polaczenie.Close();
                MessageBox.Show("Pomyślnie dodano nowy pojazd!", "Sukces");
                LoadGrid();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }

        }

        private void LoadGrid() //odczyt danych z bazy i wyświetlenie w DataGrid
        {
            this.danezbazy.ItemsSource = null;
            this.danezbazy.Items.Clear();
            String mojePolaczenie = "Server=projekttankowania.cba.pl;Port=3306;Database=maska989;Uid=Maska989;Password=BazaProjekt2;";
            MySqlConnection Polaczenie = new MySqlConnection(mojePolaczenie);
            string ZapytanieSQL = "select marka as 'Marka pojazdu',model as 'Model pojazdu',nr_rej as 'Numer rejestracyjny',komentarz as 'Komentarz' from Samochody s,Uzytkownik u where u.idUzytkownika='" + idU + "' and s.idUzytkownika = u.idUzytkownika;";

            MySqlDataAdapter AdapterSQL = new MySqlDataAdapter();
            AdapterSQL.SelectCommand = new MySqlCommand(ZapytanieSQL, Polaczenie);
            MySqlCommandBuilder builder = new MySqlCommandBuilder(AdapterSQL);

            Polaczenie.Open();
            DataTable dane = new DataTable();
            AdapterSQL.Fill(dane);

            danezbazy.ItemsSource = dane.DefaultView;
            danezbazy.ColumnWidth = 200;
        }

        private void Window_MouseDoubleClick(object sender, MouseButtonEventArgs e)
        {
            
        }

        private void Button_Click_1(object sender, RoutedEventArgs e) //przycisk usuń
        {
            try
            {
                DataRowView dataRowView = (DataRowView)danezbazy.SelectedItem;

                removeitem = dataRowView["Numer rejestracyjny"].ToString(); //pobranie numeru rejestracyjnego zaznaczonego samochodu

                MessageBoxResult result = MessageBox.Show(string.Format("Czy chcesz skasować auto o numerze {0} ?", removeitem), "Kasowanie pojazdu", MessageBoxButton.YesNo);

                if (result == MessageBoxResult.Yes)
                {
                    try
                    {
                        String mojePolaczenie = "Server=projekttankowania.cba.pl;Port=3306;Database=maska989;Uid=Maska989;Password=BazaProjekt2;";
                        MySqlConnection Polaczenie = new MySqlConnection(mojePolaczenie);

                        MySqlCommand command = Polaczenie.CreateCommand();
                        command.CommandText = "DELETE FROM Samochody s WHERE nr_rej ='" + removeitem + "';";

                        Polaczenie.Open();
                        command.ExecuteNonQuery();
                        Polaczenie.Close();
                        MessageBox.Show("Pomyślnie skasowano pojazd!", "Sukces");
                        LoadGrid();
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
            catch (Exception ex) { 
                MessageBox.Show(ex.Message); 
            };
        }
    }
}
