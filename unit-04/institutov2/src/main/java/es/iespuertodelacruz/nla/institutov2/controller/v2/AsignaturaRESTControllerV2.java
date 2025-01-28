package es.iespuertodelacruz.nla.institutov2.controller.v2;

import es.iespuertodelacruz.nla.institutov2.controller.interfaces.IControllerV2;
import es.iespuertodelacruz.nla.institutov2.dto.AsignaturaDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.services.AsignaturaService;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.logging.Logger;
import java.util.stream.Collectors;
@RestController
@CrossOrigin
@RequestMapping("/instituto/api/v2/asignaturas")
public class AsignaturaRESTControllerV2 implements IControllerV2<AsignaturaDTO, Integer> {

    @Autowired
    AsignaturaService service;

    @GetMapping
    @Override
    public ResponseEntity<List<AsignaturaDTO>> getAll() {
        Logger logger = Logger.getLogger(Globals.LOGGER_ASIGNATURA);
        logger.info("Buscando a todas las asignaturas");
        return ResponseEntity.ok(service.findAll().stream().map(asignatura -> new AsignaturaDTO(
                        asignatura.getId(), asignatura.getCurso(), asignatura.getNombre()))
                .collect(Collectors.toList()));
    }
    @GetMapping("/{id}")
    @Override
    public ResponseEntity<AsignaturaDTO> getById(@RequestParam(value = "id")Integer id) {
        Logger logger = Logger.getLogger(Globals.LOGGER_ASIGNATURA);
        logger.info("Buscando la asignatura con el id: " + id);
        Asignatura aux = service.findById(id);

        if (aux != null){
            AsignaturaDTO record = new AsignaturaDTO(aux.getId(),
                    aux.getCurso(), aux.getNombre());
            return ResponseEntity.ok(record);
        }

        return null;
    }

}
