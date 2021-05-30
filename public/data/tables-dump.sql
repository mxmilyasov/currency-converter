create table if not exists converter_results
(
    id int auto_increment
        primary key,
    fromCurrency varchar(10) not null,
    toCurrency varchar(10) not null,
    rate decimal(8,6) not null,
    convertResult decimal(8,2) not null,
    amount decimal(8,2) not null,
    createdAt datetime not null
)
    collate=utf8_unicode_ci;

create table if not exists currencies
(
    id int auto_increment
        primary key,
    code varchar(3) not null,
    name varchar(100) not null,
    symbol varchar(10) null
)
    collate=utf8_unicode_ci;

create table if not exists settings
(
    id int auto_increment
        primary key,
    selectedCurrencies longtext null,
    historyListSize int null
)
    collate=utf8_unicode_ci;