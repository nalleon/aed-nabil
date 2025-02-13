package es.iespuertodelacruz.nla;

import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.IUserEntityMapper;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.IUserEntityRepository;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.UserEntity;
import org.junit.jupiter.api.Test;
import org.springframework.boot.test.context.SpringBootTest;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.jdbc.Sql;
import java.util.*;
@SpringBootTest
@ActiveProfiles("test")
@Sql("/tictactoetest.sql")
class TicTacToeApplicationTests {

	public static final String MESSAGE_ERROR = "Expected result not found";
	@Autowired
	IUserEntityRepository repository;

	@Test
	void contextLoads() {
	}

	@Test
	void databaseH2(){
		List<UserEntity> list = new ArrayList<>();
		list = repository.findAll();
		Assertions.assertNotNull(list, MESSAGE_ERROR);
		Assertions.assertEquals(1, list.size(), MESSAGE_ERROR);
	}

}
