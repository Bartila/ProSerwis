PROSERWIS INSTRUKCJA URUCHOMIENIA

Instrukcja uruchomienia:
- Rozpakuj cały folder CycleSyncHub
- W katalogu głównym znajdziesz plik .env.example.
	Zmień jego nazwę na .env lub usuń jeśli już posiadasz plik .env
- otwórz bazę danych np. phpMyAdmin (http://localhost/phpmyadmin)
- Utwórz nową bazę danych
- Zaimportuj plik bazy danych z głównego katalogu projektu - plik wsb_2025.sql
- Instalacja zależności (terminal) :
	- composer install
	-npm install
	-npm run build
	-php artisan key:generate 
- Jeśli chcesz zacząć z pustą bazą:
	-php artisan migrate
- uruchomienie serweru  	
	- php artisan serve

Admin:
admin@test.pl, hasło: Admin123!
Owner:
owner@test.pl, hasło: Owner123!
User:
user@test.pl, hasło: User123!
