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
using System.Windows.Navigation;
using System.Windows.Shapes;
using System.Data;
using MySql.Data.MySqlClient;

namespace SystemTankowania
{
    /// <summary>
    /// Logika interakcji dla klasy MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        public MainWindow()
        {
            InitializeComponent();
        }

        private void Button_Click(object sender, RoutedEventArgs e)
        {
            Zaloguj();
        }

        private void loginbox_GotMouseCapture(object sender, MouseEventArgs e)
        {
            loginbox.Clear();
        }

        private void passbox_GotMouseCapture(object sender, MouseEventArgs e)
        {
            passbox.Clear();
        }

        private void Window_Closing(object sender, System.ComponentModel.CancelEventArgs e)
        {
            Environment.Exit(0);
        }

        private void Window_KeyDown_1(object sender, KeyEventArgs e) //obsługa klawiszy
        {
            if (e.Key == Key.Enter)
            {
                Zaloguj();
            }
            if (e.Key == Key.Tab) //czyszczenie pola hasło po wciśnięciu tab
            {
                passbox.Clear();
            }
        }

        void Zaloguj()
        {
            if (loginbox.Text == "test" && passbox.Password.ToString() == "test") //tryb testowy
            {
                MessageBox.Show("Tryb testowy - wykresy cen paliw");
                statstest ws = new statstest();
                ws.Show();

            }
            else //logowanie z bazy danych
            {
                try
                {
                    String mojePolaczenie = "Server=projekttankowania.cba.pl;Port=3306;Database=maska989;Uid=Maska989;Password=BazaProjekt2;";
                    MySqlConnection Polaczenie = new MySqlConnection(mojePolaczenie);
                    string ZapytanieSQL = "select idUzytkownika,haslo,ranga,firma,nazwaFirmy from Uzytkownik where login='" + loginbox.Text + "';";
                    MySqlDataReader reader = null;
                    MySqlDataAdapter AdapterSQL = new MySqlDataAdapter();
                    AdapterSQL.SelectCommand = new MySqlCommand(ZapytanieSQL, Polaczenie);
                    MySqlCommandBuilder builder = new MySqlCommandBuilder(AdapterSQL);

                    Polaczenie.Open();
                    MySqlCommand command = new MySqlCommand(ZapytanieSQL, Polaczenie);
                    reader = command.ExecuteReader();

                    while (reader.Read()) //zapis odczytanych danych do zmiennych
                    {
                        int idUzytkownika = (int)reader["idUzytkownika"];
                        string haslo = (string)reader["haslo"];
                        int ranga = (int)reader["ranga"];
                        int firma = (int)reader["firma"];
                        string nazwaFirmy = (string)reader["nazwaFirmy"];
                        if (passbox.Password.ToString() == haslo)
                        {
                            Window w = new Window1(idUzytkownika, loginbox.Text, ranga, firma, nazwaFirmy);
                            w.Show();
                            this.Hide();
                        }
                        else
                        {
                            MessageBox.Show("Nieprawidłowe dane logowania! Spróbuj ponownie.");
                        }
                    }

                    Polaczenie.Close();

                }
                catch (Exception ex)
                {
                    MessageBox.Show(ex.Message);
                }
            }
        }

        private void Button_Click_2(object sender, RoutedEventArgs e)
        {
            MessageBox.Show("Aplikacja przeznaczona jest dla zarejestrowanych użytkowników. Jeśli nie masz jeszcze konta, skorzystaj z rejestracji na stronie WWW systemu tankowania.", "Informacja");
        }
    }
}
