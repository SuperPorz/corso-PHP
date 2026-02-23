-- Ingredienti
INSERT INTO ingredienti (nome_ingrediente) VALUES
('Pomodoro'),
('Mozzarella'),
('Basilico'),
('Farina'),
('Uova'),
('Parmigiano'),
('Prosciutto'),
('Funghi'),
('Burro'),
('Zucchero');

-- Piatti
INSERT INTO piatti (nome_piatto, tipo) VALUES
('Spaghetti al pomodoro', 'primo'),
('Risotto ai funghi', 'primo'),
('Lasagne', 'primo'),
('Pollo arrosto', 'secondo'),
('Scaloppine al limone', 'secondo'),
('Branzino al forno', 'secondo'),
('Cotoletta alla milanese', 'secondo'),
('Tiramisù', 'dolce'),
('Panna cotta', 'dolce'),
('Torta della nonna', 'dolce');

-- Menu
INSERT INTO menu (nome_menu, data_inizio, data_fine) VALUES
('Menu Primavera', '2024-03-01', '2024-05-31'),
('Menu Estate', '2024-06-01', '2024-08-31'),
('Menu Autunno', '2024-09-01', '2024-11-30'),
('Menu Inverno', '2024-12-01', '2025-02-28'),
('Menu Pasqua', '2024-03-28', '2024-04-01'),
('Menu Natale', '2024-12-20', '2024-12-26'),
('Menu Ferragosto', '2024-08-14', '2024-08-16'),
('Menu Degustazione', '2024-01-01', '2024-12-31'),
('Menu del Giorno', '2024-04-01', '2024-04-30'),
('Menu Gourmet', '2024-05-01', '2024-05-31');

-- Piatto_Ingrediente (ogni piatto ha almeno qualche ingrediente)
INSERT INTO piatto_ingrediente (id_ingrediente, id_piatto) VALUES
(1, 1),  -- Spaghetti al pomodoro -> Pomodoro
(4, 1),  -- Spaghetti al pomodoro -> Farina
(3, 1),  -- Spaghetti al pomodoro -> Basilico
(8, 2),  -- Risotto ai funghi -> Funghi
(6, 2),  -- Risotto ai funghi -> Parmigiano
(4, 3),  -- Lasagne -> Farina
(1, 3),  -- Lasagne -> Pomodoro
(2, 3),  -- Lasagne -> Mozzarella
(5, 5),  -- Scaloppine -> Uova
(9, 9);  -- Panna cotta -> Burro

-- Menu_Piatti (ogni menu ha 1 primo, 1 secondo, 1 dolce)
INSERT INTO menu_piatti (id_menu, id_piatto) VALUES
(1, 1),  -- Menu Primavera -> Spaghetti al pomodoro (primo)
(1, 4),  -- Menu Primavera -> Pollo arrosto (secondo)
(1, 8),  -- Menu Primavera -> Tiramisù (dolce)
(2, 2),  -- Menu Estate -> Risotto ai funghi (primo)
(2, 6),  -- Menu Estate -> Branzino al forno (secondo)
(2, 9),  -- Menu Estate -> Panna cotta (dolce)
(3, 3),  -- Menu Autunno -> Lasagne (primo)
(3, 7),  -- Menu Autunno -> Cotoletta (secondo)
(3, 10), -- Menu Autunno -> Torta della nonna (dolce)
(4, 1);  -- Menu Inverno -> Spaghetti al pomodoro (primo)

-- Prenotazioni
INSERT INTO prenotazioni (data_prenotazione, nominativo) VALUES
('2024-03-15', 'Mario Rossi'),
('2024-03-15', 'Lucia Bianchi'),
('2024-04-10', 'Giovanni Verdi'),
('2024-04-10', 'Anna Neri'),
('2024-05-20', 'Francesco Esposito'),
('2024-06-01', 'Chiara Romano'),
('2024-06-15', 'Luca Ferrari'),
('2024-07-04', 'Sara Colombo'),
('2024-08-14', 'Paolo Ricci'),
('2024-09-09', 'Marta Conti');