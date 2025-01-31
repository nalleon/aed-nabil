package es.iespuertodelacruz.nla.lottery.task;
import es.iespuertodelacruz.nla.lottery.domain.Lottery;
import org.springframework.scheduling.annotation.Scheduled;
import org.springframework.stereotype.Component;

import java.util.Date;


@Component
public class ProgrammedTask {
    public static final long PERIODICIDAD = 10000;

    @Scheduled(fixedRate = PERIODICIDAD) // 3600000 ms = 1 hora
    public void task() {
        Lottery instance = Lottery.getInstance();
        instance.getCurrentRaffle();
        System.out.println("New lottery: " + instance.getCurrentRaffle().toString());
    }
}
