package es.iespuertodelacruz.jc.acertarnumero.task;

import java.util.Date;
import java.util.List;

import org.springframework.scheduling.annotation.Scheduled;
import org.springframework.stereotype.Component;


@Component
public class TareaProgramada {
	public static final long PERIODICIDAD = 10000;
	   
    @Scheduled(fixedRate = PERIODICIDAD ) // 3600000 ms = 1 hora
	public void tarea() {
		System.out.println(new Date());
	}
	
}




