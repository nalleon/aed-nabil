package es.iespuertodelacruz.nla.institutov2.tasks;

import java.util.Date;
import java.util.List;

import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.repository.IUsuarioRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.scheduling.annotation.Scheduled;
import org.springframework.stereotype.Component;


@Component
public class RemoveNotValidatedRegisters {

    @Autowired
    private IUsuarioRepository usuarioRepository;

    //cron = "segundo minuto hora día-del-mes mes día-de-la-semana"
    // Usamos * para todo, e ? para informar: sin especificar el día de la semana
    @Scheduled(cron = "0 0 0 * * ?")
    public void remove() {
        long tiempoComprobacion = 24 * 60 * 60 * 1000;
        List<Usuario> all = usuarioRepository.findAll();
        List<Integer> idsParaBorrar = all.stream()
                .filter(u->u.getVerificado() == 0)
                .filter(u->u.getFecha_creacion().getTime() + tiempoComprobacion
                        < (new Date()).getTime())
                .map(Usuario::getId)
                .toList();

        idsParaBorrar.forEach(id->usuarioRepository.deleteById(id));

        System.out.println("tarea programada desencadenada: " + (new Date()));
    }

}