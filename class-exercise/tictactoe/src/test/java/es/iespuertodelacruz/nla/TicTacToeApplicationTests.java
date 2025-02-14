package es.iespuertodelacruz.nla;

import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.domain.port.primary.IUserService;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities.IUserEntityRepository;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities.UserEntity;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.jdbc.Sql;

import java.util.ArrayList;
import java.util.List;

@SpringBootTest
@ActiveProfiles("test")
@Sql("/tictactoetest.sql")
class TicTacToeApplicationTests {

	public static final String MESSAGE_ERROR = "Expected result not found";
	@Autowired
	IUserService repository;

	@Test
	void contextLoads() {
	}

//	@Test
//	void databaseH2(){
//		List<User> list = repository.findAll();
//		Assertions.assertNotNull(list, MESSAGE_ERROR);
//		Assertions.assertEquals(1, list.size(), MESSAGE_ERROR);
//	}

}
