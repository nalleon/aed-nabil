package es.iespuertodelacruz.jc.apiprueba202425;

import static org.junit.jupiter.api.Assertions.assertNotNull;
import static org.junit.jupiter.api.Assertions.assertTrue;

import java.util.List;
import java.util.Optional;

import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.jdbc.Sql;

import es.iespuertodelacruz.jc.apiprueba202425.entities.Usuario;
import es.iespuertodelacruz.jc.apiprueba202425.repositories.UsuarioRepository;


@SpringBootTest
@ActiveProfiles("test")
@Sql("/ejemploseguridad.sql")
class ApiPrueba202425ApplicationTests {
	
   
	@Autowired UsuarioRepository repository;
	@Test
	void contextLoads() {
	}
	

	@Test
	void databaseH2() {
		
		List<Usuario>findAll = repository.findAll();
		assertNotNull(findAll);
		assertTrue(findAll.size() > 0);
		
	}

}
