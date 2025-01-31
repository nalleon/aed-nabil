package es.iespuertodelacruz.nla.institutov2.controller.abstracts;

import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTOV2;
import es.iespuertodelacruz.nla.institutov2.dto.AsignaturaDTO;
import es.iespuertodelacruz.nla.institutov2.dto.MatriculaOutputDTO;
import es.iespuertodelacruz.nla.institutov2.dto.MatriculaInputDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.entities.Matricula;
import es.iespuertodelacruz.nla.institutov2.services.AlumnoService;
import es.iespuertodelacruz.nla.institutov2.services.AsignaturaService;
import org.springframework.beans.factory.annotation.Autowired;

import java.util.ArrayList;
import java.util.List;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
public abstract class MatriculaAbstractUtils {

    @Autowired
    AlumnoService alumnoService;

    @Autowired
    AsignaturaService asignaturaService;

    protected Matricula getMatriculaEntity(MatriculaInputDTO inputDTO) {
        Matricula aux = new Matricula();
        aux.setYear(inputDTO.year());

        Alumno alumnoAux = alumnoService.findById(inputDTO.alumno());

        aux.setAlumno(alumnoAux);

        List<Asignatura> asignaturaList = new ArrayList<>();
        for (Integer id : inputDTO.asignaturasId()){
            Asignatura asignaturaAux = new Asignatura();
            asignaturaAux = asignaturaService.findById(id);
            asignaturaList.add(asignaturaAux);
        }
        aux.setAsignaturas(asignaturaList);
        return aux;
    }

    protected MatriculaOutputDTO getMatriculaDTO(Matricula matriculaEntity) {
        List<AsignaturaDTO> asignaturaList = new ArrayList<>();
        for (Asignatura asignatura : matriculaEntity.getAsignaturas()){
            AsignaturaDTO dtoAsignatura = new AsignaturaDTO(
                    asignatura.getCurso(), asignatura.getNombre()
            );
            asignaturaList.add(dtoAsignatura);
        }


        AlumnoDTOV2 dtoAlumno = new AlumnoDTOV2(matriculaEntity.getAlumno().getNombre(),
                matriculaEntity.getAlumno().getApellidos());


        return new MatriculaOutputDTO(
                matriculaEntity.getYear(), asignaturaList, dtoAlumno);
    }
}
