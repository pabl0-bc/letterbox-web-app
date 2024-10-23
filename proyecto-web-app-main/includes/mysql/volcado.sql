--
-- Dumping data for table `users`
--

-- Primera parte: usuarios 1 al 15
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `profile_image`) VALUES
(1, 'john', '$2y$10$JUGZkj3f9V/ElUCqZfKX3uswN9LjmI7zJ.F6ZLEAnQxGnTSX1a8y2', 'john.doe@example.com', 0, 'user_default.png'),
(2, 'jane', '$2y$10$WRRPW7eT5aK0AaXfS9ulnemTEQmDXvqlwFfQb/Fiv2y8BgbwIAbpW', 'jane.doe@example.com', 0, 'user_default.png'),
(3, 'admin', '$2y$10$trGzrDX15w9dOe2sT9BXmuH9hUn3cfN5sUvFwtN8ARs2zFVVnUCmG', 'admin@example.com', 1, 'user_default.png'),
(4, 'usuario', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user@gmail.com', 0, 'user_default.png'),
(5, 'admin', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'admin@gmail.com', 1, 'user_default.png'),
(6, 'administrador', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'administrador@gmail.com', 1, 'user_default.png'),
(7, 'samuel', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'samuelcarrillo2003@gmail.com', 0, 'user_default.png'),
(8, 'aweew', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'awee@gmail.com', 0, 'user_default.png'),
(9, 'samcarri', '$2y$10$Bghm4TLG444lel409jWSBujhnFoC6Z0m6npbIUHBOqbb02rI9ajbi', 'samcarri@ucm.es', 0, 'user_default.png'),
(10, 'nicolas', '$2y$10$QzNQLc6TxcID1y6Pt4vtJOUoj1gqM6HyYvO4ay7e.zoXdlxp9s4Ri', 'nicolas@gmail.com', 0, 'user_default.png'),
(11, 'asdasdas', '$2y$10$Hl6Fkpx4GWcYEtpQRKcufexRx8BWa.UAKIvhS8FsR8ur9QcmuEE4O', 'adasd@gmail.com', 0, 'user_default.png'),
(15, 'leni', '$2y$10$PN38/BErNYZQYNfcoDduSOK3C5fOoat61DFK5zjL9QRwGtQsW8gSe', 'leni@gmail.com', 0, 'user_default.png'),
(18, 'image', '$2y$10$lLxSQNbDFJZE9KdO3AdCw.xfYiXW6oA2Pfr.4Qldy1QSnCMOIpaKy', 'img@profile.com', 0, 'image.jpg'),
(19, 'user1', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user1@example.com', 0, 'user_default.png'),
(20, 'user2', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user2@example.com', 0, 'user_default.png');

-- Segunda parte: usuarios 16 al 30
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `profile_image`) VALUES
(21, 'user3', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'user3@example.com', 0, 'user_default.png'),
(22, 'user4', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'user4@example.com', 0, 'user_default.png'),
(23, 'user5', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'user5@example.com', 0, 'user_default.png'),
(24, 'user6', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user6@example.com', 0, 'user_default.png'),
(25, 'user7', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user7@example.com', 0, 'user_default.png'),
(26, 'user8', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'user8@example.com', 0, 'user_default.png'),
(27, 'user9', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'user9@example.com', 0, 'user_default.png'),
(28, 'user10', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'user10@example.com', 0, 'user_default.png'),
(29, 'user11', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user11@example.com', 0, 'user_default.png'),
(30, 'user12', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user12@example.com', 0, 'user_default.png');

-- Tercera parte: usuarios 31 al 45
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `profile_image`) VALUES
(31, 'user13', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'user13@example.com', 0, 'user_default.png'),
(32, 'user14', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'user14@example.com', 0, 'user_default.png'),
(33, 'user15', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'user15@example.com', 0, 'user_default.png'),
(34, 'user16', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user16@example.com', 0, 'user_default.png'),
(35, 'user17', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user17@example.com', 0, 'user_default.png'),
(36, 'user18', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'user18@example.com', 0, 'user_default.png'),
(37, 'user19', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'user19@example.com', 0, 'user_default.png'),
(38, 'user20', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'user20@example.com', 0, 'user_default.png'),
(39, 'user21', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user21@example.com', 0, 'user_default.png'),
(40, 'user22', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user22@example.com', 0, 'user_default.png');


--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user`, `follows`, `since`) VALUES
(16, 4, 5, '2024-04-30'),
(17, 5, 4, '2024-04-30'),
(28, 15, 5, '2024-04-30');

--
-- Dumping data for table `generos`
--

INSERT INTO `generos` (`genero`) VALUES
('Acción'),
('Animación'),
('Aventuras'),
('Ciencia ficción'),
('Comedia'),
('Documental'),
('Drama'),
('Fantasía'),
('Musical'),
('Romance'),
('Terror'),
('Thriller');

--
-- Dumping data for table `peliculas`
--

INSERT INTO `peliculas` (`ID`, `nombre`, `descripcion`, `director`, `genero`, `caratula`, `trailer`, `numValoraciones`, `valoracion`) VALUES
(1, 'Avatar', 'En el futuro, un exmarine parapléjico es enviado a la luna Pandora en una misión única que eventualmente se convierte en una épica batalla por la supervivencia.', 'James Cameron', 'Ciencia ficción', 'avatar.png', 'https://www.youtube.com/embed/CpXJHWSXJW0?si=CYAiBuTn7kGFF3pl', 0, 0),
(2, 'Forrest Gump', 'La vida de Forrest Gump, un hombre con una capacidad intelectual por debajo de la media pero con buen corazón, y su extraordinario viaje a través de la historia estadounidense.', 'Robert Zemeckis', 'Comedia', 'forrestgump.png', 'https://www.youtube.com/embed/bLvqoHBptjg?si=gjVEXAAoHT1ECIoV', 0, 0),
(3, 'The Shawshank Redemp', 'Un banquero condenado a cadena perpetua por el asesinato de su esposa y su amante, encuentra esperanza en medio de la desesperación mientras planea su escape de prisión.', 'Frank Darabont', 'Drama', 'shawshankredemption.png', 'https://www.youtube.com/embed/PLl99DlL6b4?si=uDUmWdMDvjisQ8Ly', 0, 0),
(4, 'Pulp Fiction', 'La vida de varios personajes interconectados, incluidos dos asesinos a sueldo, un boxeador, un gángster y su esposa, en tres historias entrelazadas.', 'Quentin Tarantino', 'Drama', 'pulpfiction.png', 'https://www.youtube.com/embed/s7EdQ4FqbhY?si=ujNd7lHeykVYkB2z', 0, 0),
(5, 'The Dark Knight', 'Cuando el caos irrumpe en Gotham City debido a la aparición del Joker, Batman debe enfrentarse a una de las pruebas más grandes de su vida.', 'Christopher Nolan', 'Acción', 'darkknight.png', 'https://www.youtube.com/embed/Qs-NylETt1E?si=DvuAFY9GLHyAR0QF', 0, 0),
(6, 'Fight Club', 'Un insomne empleado de oficina y un fabricante de jabón deprimido forman un club clandestino de lucha, revolucionando pronto toda la ciudad.', 'David Fincher', 'Drama', 'fightclub.png', 'https://www.youtube.com/embed/BdJKm16Co6M?si=FT_sqL2Ik9OTip7J', 0, 0),
(7, 'Inception', 'Un ladrón especializado en robar secretos del subconsciente durante el estado de sueño es contratado para implantar una idea en la mente de un CEO.', 'Christopher Nolan', 'Acción', 'inception.png', NULL, 0, 0),
(8, 'Titanic', 'Un joven aventurero y una hermosa arist&amp;oacute;crata se encuentran a bordo del infortunado RMS Titanic durante su viaje inaugura.', 'James Cameron', 'Drama', 'titanic.png', 'https://www.youtube.com/embed/tA_qMdzvCvk?si=wGMbhBcJfEXdUDMM', 0, 4),
(9, 'Barbie', 'Después de ser expulsada de Barbieland por no ser una muñeca de aspecto perfecto, Barbie parte hacia el mundo humano para encontrar la verdadera felicidad', 'Greta Gerwig', 'Comedia', 'Barbie.jpg', 'https://www.youtube.com/embed/eUP3hlBel5I?si=IEJg4XVQKfTbESHR', 0, 0),
(10, 'Gladiator', 'El general romano Máximo es el soporte más leal del emperador Marco Aurelio, que lo ha conducido de victoria en victoria. Sin embargo, Cómodo, el hijo de Marco Aurelio, está celoso del prestigio de Máximo y aún más del amor que su padre siente por él.', 'Ridley Scott', 'Acción', 'Gladiator.jpg', 'https://www.youtube.com/embed/P5ieIbInFpg?si=NbeZsbqCNLVbmCKN', 0, 0),
(11, 'El dictador', 'El Almirante Haffaz Aladeen (Baron Cohen), un dictador antioccidental, arriesga su vida con tal de evitar el establecimiento de la democracia en Wadiya, un país norteafricano con recursos petrolíferos. Su más fiel consejero es su tío Tamir (Ben Kingsley), Jefe de la Policía Secreta, Jefe de Seguridad y Proveedor de Mujeres. Por desgracia para Aladeen y sus consejeros, Occidente ha empezado a inmiscuirse en los asuntos de Wadiya, país que ha sido sancionado varias veces por las Naciones Unidas en la última década. Tras sufrir un atentado que le cuesta la vida a uno de sus consejeros, Tamir convence a Aladeen para que vaya a Nueva York a solucionar la cuestión en la ONU', 'Sacha Baron-Cohen', 'Comedia', 'El dictador.jpg', 'https://www.youtube.com/embed/opqLwNj0428?si=Tss0_6DnloibNwsb', 0, 0),
(12, 'Los increibles', 'Un súper héroe retirado lucha contra el aburrimiento en un suburbio y junto con su familia tiene la oportunidad de salvar al mundo.', 'Brad Bird', 'Animación', 'Los increibles.jpeg', '//www.youtube.com/embed/6-Vql6wlW7o?si=SoFxkLB-mrwXRpvl', 0, 0),
(13, 'Cars', 'El aspirante a campeón de carreras Rayo McQueen parece que está a punto de conseguir el éxito. Su actitud arrogante se desvanece cuando llega a una pequeña comunidad olvidada que le enseña las cosas importantes de la vida que había olvidado.', 'John Lasseter', 'Animación', 'Cars.jpg', '//www.youtube.com/embed/W_H7_tDHFE8?si=4-Tfsveidv3qXoex', 0, 5),
(14, 'Gran Torino', 'Walt Kowalski, un veterano de la guerra de Corea, es un obrero jubilado del sector del automóvil que ha enviudado recientemente. Su máxima pasión es cuidar de su más preciado tesoro: un coche Gran Torino de 1972', 'Clint Eastwood', 'Acción', 'Gran Torino.jpg', '//www.youtube.com/embed/RMhbr2XQblk?si=x82aS_3FoX5qLVs3', 0, 0),
(15, 'Shrek', 'Hace mucho tiempo, en una lejana ciénaga, vivía un ogro llamado Shrek. Un día, su preciada soledad se ve interrumpida por un montón de personajes de cuento de hadas que invaden su casa. Todos fueron desterrados de su reino por el malvado Lord Farquaad.', 'Andrew Adamson', 'Animación', 'Shrek.jpg', '//www.youtube.com/embed/B88JfTyJ1Fw?si=_YXlKG1DSve3yboI', 0, 0),
(16, 'Interestellar', 'Un astronauta viaja en el tiempo para salvar la humanidad del cierre de un agujero negro.', 'Christopher Nolan', 'Ciencia ficción', 'interstellar.jpg', 'https://www.youtube.com/embed/hhCtMhk8eHo?si=HvPDlDYZgHqToo0N', 0, 0),
(17, 'Moana', 'Una joven chica de Hawái parte en un peregrinaje para rescatar a su padre y restaurar el poder de la deidad de la vida.', 'Ron Huerta', 'Animación', 'moana.jpg', 'https://www.youtube.com/embed/tmpTGztGJ8E?si=Xf-JBXTWzfmnRZHw', 0, 0),
(18, 'Spotlight', 'Un equipo de periodistas de Boston descubre un escándalo de abusos sexual cometidos por clérigos católicos y lucha contra la corrupción para denunciarlo.', 'Tom McCarthy', 'Drama', 'spotlight.jpg', 'https://www.youtube.com/embed/3G2EgJBkNaQ?si=wK-HCyL70SiCHHHk', 0, 0),
(19, 'La La Land', 'Un músico de jazz y una bailarina de ballet se enamoran mientras trabajan juntos en una producción cinematográfica.', 'James Bill', 'Drama', 'lala-land.jpg', 'https://www.youtube.com/embed/45s24h98iOc?si=V03Z6FtvubQU0k84', 0, 0),
(20, 'The Revenant', 'Un hombre sobreviviente de un masacro en el siglo XIX, que lleva a cabo una travesía peligrosa y perilosa para encontrar a su hermano que también sobrevivió.', 'Alejandro G. Iddia', 'Acción', 'revenant.jpg', 'https://www.youtube.com/embed/LoebZZ8K5N0?si=_unAC9o8C5y6n-E8', 0, 0),
(21, 'The Big Short', 'Tras el desastre bursátil de 2008, un hombre sin trabajo y un experto en juegos de azar se unen para detener a los banqueros y los traders que llevaron al mundo a la quiebra.', 'Adam McKay', 'Documental', 'big-short.jpg', 'https://www.youtube.com/embed/vgqG3ITMv1Q?si=TJM0GZn2Z0lc66oR', 0, 0),
(23, 'Sicario: Otra vida', 'Un hombre de la CIA, que lleva una vida en la que asesina a gente sin cuestionar, debe enfrentarse a su pasado cuando es traído de regreso a la acción.', 'Denis Villeneuve', 'Acción', 'sicario2.jpg', 'https://www.youtube.com/embed/Pymm6cmE9uQ?si=KnpnuWA7jkntsihY', 0, 0),
(24, '12 Hombres Sin Línea', 'Un hombre, desesperado por la muerte de su mujer, se une a un equipo de mercenarios para llevar a cabo una misión peligrosa en el Congo.', 'Kenneth Renker', 'Acción', '12-hombres.jpg', 'https://www.youtube.com/embed/TEN-2uTi2c0?si=hew4RzaJxINO0ILQ', 0, 0),
(25, 'Black Panther', 'En el universo de Wakanda, T’Challa, el rey de Wakanda, lucha por mantener su reino y su gente en paz, mientras se enfrenta a las amenazas externas y内部.', 'Ryan Coogler', 'Acción', 'blackpanther.png', 'https://www.youtube.com/embed/JK-wAfAvJ0g?si=XRJmvGYbp6nQDc9K', 0, 0),
(26, 'Joker', 'Un hombre en el borde de la locura, que comete un asesinato después de otro y lleva a cabo una serie de crímenes en Nueva York.', 'Todd Phillips', 'Terror', 'joker.png', 'https://www.youtube.com/embed/ygUHhImN98w?si=17OZ2VOk6I2xjN7L', 0, 0),
(27, 'Parasitos', 'Una familia de obreros migratorios se encuentra en medio de una lucha económica para ganar el suficiente dinero para pagar una operación quirúrgica que les permitirá a su hija nacer.', 'Bong Joon-ho', 'Terror', 'parasitos.png', 'https://www.youtube.com/embed/5xH0HfJHsaY?si=IxQyzyVEdNHnKAmY', 0, 0),
(28, 'Crazy Rich Asians', 'Una mujer estadounidense se casa con un hombre rico y exclusivo, pero pronto descubre que su nuevo marido vive en un mundo de lujo y extravagancia.', 'Jon M. Chu', 'Romance', 'crazyrichasians.png', 'https://www.youtube.com/embed/ZQ-YX-5bAs0?si=rww4ETBJX_UzNSPv', 0, 0),
(29, 'The Lighthouse', 'Dos hombres de diferentes épocas y lugares, que viven en un islote remoto, se encuentran y comienzan a descubrir verdades sobre su pasado y sobre ellos mismos.', 'Robert Eggers', 'Historia', 'thelighthouse.jpg', 'https://www.youtube.com/embed/Hyag7lR8CPA?si=WRpqs-U6TQHNr4Cu', 0, 0),
(30, 'Midsommar', 'Una mujer y su hija se dirigen a Suecia para pasar las fiestas de San Juan, pero pronto descubren que los antiguos mitos y leyendas de esa tierra serán la realidad.', 'Wilson y Alexander', 'Terror', 'midsommar.jpg', 'https://www.youtube.com/embed/YKhlKGQsyw4?si=f-RjRo_xGdhu8KGr', 0, 0),
(31, 'First Man', 'La historia de Neil Armstrong y los primeros pasos humanos en el espacio.', 'Ryan Coogler', 'Drama', 'firstman.jpg', 'https://www.youtube.com/embed/JnISFkVs4Q0?si=G_5Bdgdsss_nAMIm', 0, 0),
(32, 'The Irishman', 'La historia de las últimas horas de Scarface, Don Vito Andolini, y cómo terminó su vida.', 'Martin Scorsese', 'Terror', 'theirishman.jpg', 'https://www.youtube.com/embed/WHXxVmeGQUc?si=R68vmOWssO6eNolu', 0, 0),
(33, 'The King''s Man', 'Los hombres que salvan el mundo deberán enfrentarse a un mundo que se encuentra en crisis.', 'Todd Phillips', 'Acción', 'thekingsman.jpg', 'https://www.youtube.com/embed/Rs5J8kh62yo?si=adz-G95PqG1svNbn', 0, 0),
(34, 'The Tragedy of Macbeth', 'La historia de Macbeth, un hombre que comete un asesinato y se enfrenta a la conciencia.', 'Sofia Coppola', 'Terror', 'thetragedyofmacbeth.jpg', 'https://www.youtube.com/embed/ptqe7s6pO7g?si=Ex_Desk6T0UcyvK6', 0, 0),
(35, 'The White Princess', 'La historia de una mujer que se encuentra en medio de la Guerra de las Rosas y debe descubrir lo que es amor verdadero.', 'Joan Chombhaut', 'Drama', 'thewhiteprincess.jpg', 'https://www.youtube.com/embed/TJ-q3_b3dkI?si=iS4po3mZ90URqRdu', 0, 0);

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ID`, `usuario`, `titulo`, `critica`, `puntuacion`, `pelicula`) VALUES
(0, 'administrador', 'nais', 'esta guapa', 5, 'Titanic'),
(2, 'administrador', 'nais', 'esta bien', 3, 'Titanic'),
(5, 'administrador', 'nais', 'asdas', 5, 'Titanic'),
(9, 'user1', 'Genial', 'Una película increíble, la trama te atrapa desde el principio.', 5, 'Forrest Gump'),
(10, 'user2', 'Entretenida', 'Me gustó mucho la historia y los personajes.', 4, 'Pulp Fiction'),
(11, 'user3', 'Muy buena', 'Excelente película, la actuación es sobresaliente.', 5, 'The Shawshank Redemption'),
(12, 'user4', 'Inolvidable', 'Una película que deja huella, la recomiendo totalmente.', 5, 'Gran Torino'),
(13, 'user5', 'Divertida', 'Me reí mucho con esta película, es perfecta para desconectar.', 4, 'Shrek'),
(14, 'user6', 'Impactante', 'La trama te mantiene en vilo todo el tiempo, muy recomendable.', 5, 'Inception'),
(15, 'user7', 'Emocionante', 'Una película que te llega al corazón, no pude contener las lágrimas.', 5, 'Titanic'),
(16, 'user8', 'Interesante', 'Una película que te hace reflexionar, muy bien realizada.', 4, 'Fight Club'),
(17, 'user9', 'Imprescindible', 'Una obra maestra del cine, no te la puedes perder.', 5, 'The Dark Knight'),
(18, 'user10', 'Sorprendente', 'Me dejó sin palabras, una de las mejores películas que he visto.', 5, 'Gladiator'),
(19, 'user11', 'Recomendable', 'Una película muy entretenida, perfecta para pasar un buen rato.', 4, 'Los increíbles'),
(20, 'user12', 'Asombrosa', 'Los efectos especiales son increíbles, te sumergen por completo en la historia.', 5, 'Avatar'),
(21, 'user13', 'Desgarradora', 'Una película que te hace reflexionar sobre la naturaleza humana.', 4, 'El dictador'),
(22, 'user14', 'Divertida', 'Una comedia muy entretenida, perfecta para ver en familia.', 4, 'Barbie'),
(23, 'user15', 'Impactante', 'Me sorprendió gratamente, la trama tiene giros inesperados.', 5, 'Cars'),
(24, 'user16', 'Emocionante', 'Una película que te mantiene en vilo de principio a fin.', 5, 'Shrek'),
(25, 'user17', 'Sobrecogedora', 'No podía apartar la vista de la pantalla, una experiencia inolvidable.', 5, 'Gran Torino'),
(26, 'user18', 'Intrigante', 'Una película que te hace cuestionarte todo, muy interesante.', 4, 'Inception'),
(27, 'user19', 'Divertida', 'Me reí a carcajadas, una comedia perfecta.', 4, 'The Shawshank Redemption'),
(28, 'user20', 'Inolvidable', 'Una película que te deja pensando mucho después de verla.', 5, 'Pulp Fiction'),
(29, 'user21', 'Impactante', 'Los efectos especiales son alucinantes, te transportan a otro mundo.', 5, 'Avatar'),
(30, 'user22', 'Emocionante', 'Una película que te llega al corazón, no pude contener las lágrimas.', 5, 'The Dark Knight'),
(31, 'user13', 'Interesante', 'Una trama intrigante que te mantiene enganchado en todo momento.', 4, 'Fight Club'),
(32, 'user14', 'Divertida', 'Una comedia ligera perfecta para desconectar.', 4, 'Los increíbles'),
(33, 'user15', 'Conmovedora', 'Una película que te hace reflexionar sobre la vida.', 5, 'Forrest Gump'),
(34, 'user16', 'Emocionante', 'Me mantuvo al borde del asiento todo el tiempo, muy recomendable.', 5, 'Gladiator'),
(35, 'user17', 'Impresionante', 'Una película que te deja sin aliento, la recomiendo totalmente.', 5, 'Titanic'),
(36, 'user18', 'Genial', 'Una película que te hace reflexionar sobre la naturaleza humana.', 5, 'El dictador'),
(37, 'user19', 'Divertida', 'Una comedia muy entretenida, perfecta para ver en familia.', 4, 'Barbie'),
(38, 'user20', 'Impactante', 'Los efectos especiales son increíbles, te sumergen por completo en la historia.', 5, 'Cars'),
(39, 'user21', 'Emocionante', 'Una película que te mantiene en vilo de principio a fin.', 5, 'Shrek'),
(40, 'user22', 'Sobrecogedora', 'No podía apartar la vista de la pantalla, una experiencia inolvidable.', 5, 'Gran Torino');


--
-- Dumping data for table `post`
--

-- Insertar nuevas publicaciones
--
-- Dumping data for table `post`
--

INSERT INTO `post` (`ID`, `ID_usuario`, `titulo`, `texto`, `likes`) VALUES
(21, 21, 'Una película de ciencia ficción imperdible', 'Recién vi esta película de ciencia ficción y quedé impresionado. ¡Los efectos especiales son asombrosos!', 15),
(22, 22, 'Una comedia para alegrar el día', 'Si necesitas una dosis de risas, esta comedia es perfecta para ti. ¡No podrás contener la carcajada!', 25),
(23, 23, 'Un drama con actuaciones increíbles', 'Esta película te llevará en un viaje emocional con sus actuaciones conmovedoras y una historia poderosa.', 20),
(24, 24, 'Una joya del cine negro', 'Si eres fanático del cine negro, esta película es un must-see. Intriga, suspense y giros inesperados te esperan.', 30),
(25, 25, 'Una película de terror para los valientes', '¿Te atreves a ver esta película de terror? Prepárate para los sustos más escalofriantes de tu vida.', 18),
(26, 26, 'Una aventura épica en tierras desconocidas', 'Únete a esta emocionante aventura llena de peligros, misterios y descubrimientos asombrosos.', 22),
(27, 27, 'Un thriller psicológico que te dejará sin aliento', 'Prepárate para una experiencia intensa con este thriller psicológico que te hará cuestionar la realidad.', 28),
(28, 28, 'Una película animada para toda la familia', 'Disfruta de las risas y la diversión con esta encantadora película animada que cautivará a grandes y pequeños.', 35),
(29, 29, 'Una historia de amor inolvidable', 'Déjate envolver por esta emotiva historia de amor que te llegará directo al corazón. ¡Prepara los pañuelos!', 40),
(30, 30, 'Una película de culto para los cinéfilos', 'Si eres un amante del cine, esta película icónica no puede faltar en tu lista de must-watch. ¡Un verdadero clásico!', 50),
(31, 31, 'Una película basada en hechos reales', 'Sumérgete en esta impactante historia basada en hechos reales que te dejará reflexionando mucho después de que termine.', 55),
(32, 32, 'Una aventura en busca de la verdad', 'Acompaña a los protagonistas en una emocionante aventura llena de misterios y revelaciones impactantes.', 60),
(33, 33, 'Un viaje al pasado lleno de nostalgia', 'Revive los mejores momentos de tu infancia con esta película que te transportará a una época llena de magia y diversión.', 65),
(34, 34, 'Una película sobre la amistad y el crecimiento personal', 'Descubre el poder de la amistad y la importancia de creer en uno mismo con esta película inspiradora que tocará tu corazón.', 70),
(35, 35, 'Una película de acción al estilo clásico', 'Prepárate para una dosis de acción desenfrenada con esta película que rinde homenaje a los clásicos del género.', 75),
(36, 36, 'Una historia de venganza y redención', 'Embárcate en un viaje lleno de emociones intensas con este drama que te mantendrá al borde de tu asiento de principio a fin.', 80),
(37, 37, 'Una película sobre el poder de la música', 'Descubre cómo la música puede cambiar vidas y unir corazones en esta película inspiradora que te hará cantar y bailar.', 85),
(38, 38, 'Una película sobre la lucha por la libertad', 'Acompaña a los valientes protagonistas en su lucha por la libertad y la justicia en esta película épica que te dejará sin aliento.', 90),
(39, 39, 'Una comedia romántica para derretir corazones', 'Ríete y enamórate con esta encantadora comedia romántica que te recordará las alegrías y desafíos del amor.', 95),
(40, 40, 'Una película sobre el valor de los sueños', 'Inspírate y sueña en grande con esta película que te recordará que nunca es demasiado tarde para perseguir tus sueños.', 100);


INSERT INTO `comentarios` (`id`, `id_post`, `id_usuario`, `contenido`)
VALUES
(1, 21, 1, '¡Excelente película, la trama te atrapa desde el principio!'),
(2, 22, 2, 'Me gustó mucho la historia y los personajes.'),
(3, 23, 3, 'Excelente película, la actuación es sobresaliente.'),
(4, 24, 4, 'Una película que deja huella, la recomiendo totalmente.'),
(5, 25, 5, 'Me reí mucho con esta película, es perfecta para desconectar.'),
(6, 26, 6, 'La trama te mantiene en vilo todo el tiempo, muy recomendable.'),
(7, 27, 7, 'Una película que te llega al corazón, no pude contener las lágrimas.'),
(8, 28, 8, 'Una película que te hace reflexionar, muy bien realizada.'),
(9, 29, 9, 'Una obra maestra del cine, no te la puedes perder.'),
(10, 30, 10, 'Una película de culto para los cinéfilos. Si eres un amante del cine, esta película icónica no puede faltar en tu lista de must-watch. ¡Un verdadero clásico!'),
(11, 31, 11, 'Una película basada en hechos reales. Sumérgete en esta impactante historia basada en hechos reales que te dejará reflexionando mucho después de que termine.');




