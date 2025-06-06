CycleSyncHub to aplikacja webowa przeznaczona do zarządzania serwisem rowerowym, oparta o system ról użytkowników, które określają zakres możliwych działań. 

user:
to zwykły użytkownik systemu(pracownik/serwisant), który może zalogować się dodawać, edytować i przeglądać rowery wraz z ich szczegółami oraz obserwować postęp prac związanych ze sprzętem. 

owner:
ma wszystkie możliwości usera (to taki właściciel/kierownicy), rozszerzone o możliwość usuwania rowerów. Posiada dostęp do "panelu właściciela", gdzie może zobaczyć stan rowerów na serwisie. Oraz posiada dostęp do listy użytkowników.

Admin: 
ma wszystkie możliwości usera, rozszerzony o możliwość usuwania rowerów, a dodatkowo otrzymuje pełen dostęp do zarządzania kontami użytkowników – może dodawać, edytować oraz usuwać konta, a także przeglądać historię operacji w systemie związanych z serwisem rowerów. 

Aplikacja pozwala na ewidencjonowanie rowerów wraz ze wszystkimi istotnymi szczegółami, takimi jak typ, komponenty, dane właściciela, opis naprawy, waga, numer telefonu, termin realizacji czy status (oczekuje, w naprawie, gotowy, odebrany). Wprowadzanie i edycja danych są kontrolowane walidacją i ograniczeniami odpowiednimi do ról, a każda operacja związana z dodawanie, edytowaniem i usuwaniem zapisywana jest w systemowym dzienniku aktywności. System automatycznie wyróżnia rowery po terminie.

Instrukcja uruchomienia:
- Rozpakuj cały folder CycleSyncHub
- W katalogu głównym znajdziesz plik .env.example.
	Zmień jego nazwę na .env.
- otwórz bazę danych np. phpMyAdmin (http://localhost/phpmyadmin)
- Utwórz nową bazę danych
- Zaimportuj plik bazy danych z głównego katalogu projektu - plik wsb_2025_k05_9.sql
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
test@test.pl, hasło: User123!
