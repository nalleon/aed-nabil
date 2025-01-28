package es.iespuertodelacruz.nla.institutov2.controller.abstracts;

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
        alumnoAux.setDni(matriculaRecord.alumno().dni());
        alumnoAux.setApellidos(matriculaRecord.alumno().apellidos());
        alumnoAux.setFechanacimiento(matriculaRecord.alumno().fechanacimiento());
        alumnoAux.setNombre(matriculaRecord.alumno().nombre());

        aux.setAlumno(alumnoAux);

        List<Asignatura> asignaturaList = new ArrayList<>();
        for (AsignaturaDTO asignaturaRecord : matriculaRecord.asignaturas()){
            Asignatura asignaturaAux = new Asignatura();
            asignaturaAux.setId(asignaturaRecord.id());
            asignaturaAux.setNombre(asignaturaRecord.nombre());
            asignaturaAux.setCurso(asignaturaRecord.curso());
            asignaturaList.add(asignaturaAux);
        }
        aux.setAsignaturas(asignaturaList);
        return aux;
    }

    protected MatriculaDTO getMatriculaRecord(Matricula aux) {
        List<AsignaturaDTO> asignaturaList = new ArrayList<>();
        for (Asignatura asignatura : aux.getAsignaturas()){
            AsignaturaDTO asignaturaRecord = new AsignaturaDTO(
                    asignatura.getId(),
                    asignatura.getCurso(), asignatura.getNombre()
            );
            asignaturaList.add(asignaturaRecord);
        }


        AlumnoDTOV3 alumnoRecord = new AlumnoDTOV3(aux.getAlumno().getDni(),
                aux.getAlumno().getApellidos(), aux.getAlumno().getFechanacimiento(),
                aux.getAlumno().getNombre());


        return new MatriculaDTO(
                aux.getYear(), asignaturaList, alumnoRecord);
    }
}
