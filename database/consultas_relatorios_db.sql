# REL 1: somente pets com tutores
SELECT * FROM pets JOIN tutores ON pets.id_tutor=tutores.id WHERE id_tutor IS not NULL;

# REL 2: somente pets sem tutores(pets disponíveis)
SELECT * FROM pets WHERE id_tutor IS NULL;

# Rel 3: todos os pets
SELECT * FROM pets;


# Rel 4: todos os tutores
SELECT * FROM tutores;



SELECT * FROM pets LEFT JOIN tutores ON pets.id_tutor=tutores.id;
SELECT * FROM pets;







SELECT 
	pets.id AS pet_id,
	pets.nome AS pet_nome,
	pets.raca AS pets,
	pets.url_foto AS pet_url_foto,
   tutores.id AS tutor_id,
   tutores.nome AS tutor_nome,
   tutores.telefone AS tutor_telefone,
   tutores.email AS tutor_email
FROM pets LEFT JOIN tutores ON pets.id_tutor=tutores.id;




