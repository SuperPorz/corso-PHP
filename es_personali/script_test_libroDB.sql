insert into joke set
joketext = "A programmer was found dead in the shower. The instructions read: lather, rinse, repeat.",
jokedate = "2017/06/01";

insert into joke (joketext, jokedate) values (
	"!False - it\'s funny because it\'s true",
    '2017-06-01');





select * from joke;

select id, left(joketext, 25), jokedate from joke;

CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
FLUSH PRIVILEGES;

