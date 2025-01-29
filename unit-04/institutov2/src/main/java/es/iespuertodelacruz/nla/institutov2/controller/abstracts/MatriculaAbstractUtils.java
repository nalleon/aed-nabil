package es.iespuertodelacruz.nla.institutov2.controller.abstracts;

import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTOV2;
import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTOV3;
import es.iespuertodelacruz.nla.institutov2.dto.AsignaturaDTO;
import es.iespuertodelacruz.nla.institutov2.dto.MatriculaDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.entities.Matricula;

import java.util.ArrayList;
import java.util.List;

public abstract class MatriculaAbstractUtils {
    protected Matricula getMatricula(MatriculaDTO matriculaRecord) {
        Matricula aux = new Matricula();
        aux.setYear(matriculaRecord.year());

        Alumno alumnoAux = new Alumno();
        alumnoAux.setApellidos(matriculaRecord.alumno().apellidos());
        alumnoAux.setNombre(matriculaRecord.alumno().nombre());

        aux.setAlumno(alumnoAux);

        List<Asignatura> asignaturaList = new ArrayList<>();
        for (AsignaturaDTO dtoAsignatura : matriculaRecord.asignaturas()){
            Asignatura asignaturaAux = new Asignatura();
            asignaturaAux.setNombre(dtoAsignatura.nombre());
            asignaturaAux.setCurso(dtoAsignatura.curso());
            asignaturaList.add(asignaturaAux);
        }
        aux.setAsignaturas(asignaturaList);
        return aux;
    }

    protected MatriculaDTO getMatriculaRecord(Matricula aux) {
        List<AsignaturaDTO> asignaturaList = new ArrayList<>();
        for (Asignatura asignatura : aux.getAsignaturas()){
            AsignaturaDTO dtoAsignatura = new AsignaturaDTO(
                    asignatura.getCurso(), asignatura.getNombre()
            );
            asignaturaList.add(dtoAsignatura);
        }


        AlumnoDTOV2 dtoAlumno = new AlumnoDTOV2(aux.getAlumno().getNombre(),
                aux.getAlumno().getApellidos());


        return new MatriculaDTO(
                aux.getYear(), asignaturaList, dtoAlumno);
    }
}
