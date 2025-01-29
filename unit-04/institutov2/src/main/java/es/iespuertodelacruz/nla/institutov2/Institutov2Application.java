package es.iespuertodelacruz.nla.institutov2;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.scheduling.annotation.EnableScheduling;

@SpringBootApplication
@EnableScheduling
public class Institutov2Application {

	public static void main(String[] args) {
		SpringApplication.run(Institutov2Application.class, args);
	}

}
