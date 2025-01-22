package es.iespuertodelacruz.jc.apiprueba202425.tasks;


import java.util.Date;
import java.util.List;
import java.util.stream.Collectors;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.scheduling.annotation.Scheduled;
import org.springframework.stereotype.Component;

import es.iespuertodelacruz.jc.apiprueba202425.entities.Usuario;
import es.iespuertodelacruz.jc.apiprueba202425.repositories.UsuarioRepository;

@Component
public class RemoveNotValidatedRegisters {
	
    @Autowired
    private UsuarioRepository usuarioRepository;

    //cron = "segundo minuto hora día-del-mes mes día-de-la-semana"
    // Usamos * para todo, e ? para informar: sin especificar el día de la semana
    @Scheduled(cron = "0 0 0 * * ?")
    public void remove() {
    	long unDia = 24 * 60 * 60 * 1000;
        List<Usuario> all = usuarioRepository.findAll();
        List<Integer> idsParaBorrar = all.stream()
        	.filter(u->u.getVerificado() == 0)
        	//.filter(u->u.getFechaCreacion() + unDia < (new Date()).getTime())
        	.map(u->u.getId())
        	.collect(Collectors.toList());
          
        //idsParaBorrar.forEach(id->usuarioRepository.deleteById(id));
        
        System.out.println("tarea programada desencadenada: " + (new Date()));
    }

}
