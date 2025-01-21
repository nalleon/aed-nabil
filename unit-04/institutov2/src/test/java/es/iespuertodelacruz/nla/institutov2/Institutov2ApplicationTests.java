package es.iespuertodelacruz.nla.institutov2;

import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.repository.IAlumnoRepository;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.jdbc.Sql;
import java.util.*;
@SpringBootTest
@ActiveProfiles("test")
@Sql("/institutotest.sql")

class Institutov2ApplicationTests {
	public static final String MESSAGE_ERROR = "Expected result not found";
	@Autowired
	IAlumnoRepository repository;

	@Test
	void contextLoads() {
	}

	@Test
	void databaseH2(){
		List<Alumno> list = new ArrayList<>();
		list = repository.findAll();
		Assertions.assertEquals(3, list.size(), MESSAGE_ERROR);
	}
}
