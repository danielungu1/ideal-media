Instalace
------------

1) Aplikace běží na PHP 8.2
2) mkdir log, mkdir temp - vytvoří potřebné složky log a temp v rootu
3) Pomocí composer 2 nainstalujte balíčky `composer install`
4) V config.local.neon si nastavte připojení k databázi

Migrace
------------
`php bin/console migrations:reset` načte všechna data do databáze

Dodatečné informace
------------
Snažil jsem se toho udělat co nejvíce nad rámec a určitě by toho šlo udělat mnohen více. Zároveň jsem se to ale snažil 
udělat co nejvíce časově úsporné, takže jsem musel zvolit kompromis a některé věci (nad rámec) nedělat. Určitě by
šla vylepšit struktura složek, stylování (někde jsem stylování vynechal, abych ušetřil čas), šly by přidat překlady, aby
byla aplikace vícejazyčná a texty by byly odděleny od kódu, nebo třeba confirm při rušení rezervace. 

Jako ORM jsem zvolil Nettrine, protože s ním mám již zkušenosti. Zakomponoval jsem i migrace, aby byla práce s daty co
nejpříjemnější. Pro práci s daty v aplikaci využívám QueryBuilder, který je velmi dostačující, a zároveň jednoduchý 
na použití, a Service na ukládání/mazání. To všechno běží na EntityManagerInterface, což je součástí ORM. Strukturu dat
jsem moc neměnil. Použil jsem základní skeleton, který se navrhuje při instalaci Nette a do toho jsem si zakomponoval
několik svých složek. Komponenty jsem psal tak, jak jsem zvyklý - je to za mě přehledné a jednoduché. Dbal jsem i na 
čistotu kódu.