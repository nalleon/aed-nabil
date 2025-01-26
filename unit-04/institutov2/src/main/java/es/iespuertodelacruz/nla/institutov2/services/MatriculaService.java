package es.iespuertodelacruz.nla.institutov2.services;

import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.entities.Matricula;
import es.iespuertodelacruz.nla.institutov2.repository.IAlumnoRepository;
import es.iespuertodelacruz.nla.institutov2.repository.IAsignaturaRepository;
import es.iespuertodelacruz.nla.institutov2.repository.IMatriculaRepository;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;
@Service
public class MatriculaService implements IServiceGeneric<Matricula, Integer>{

    public static final String ID_EXCEPTION = "El id es distinto";
    public static final String NOMBRE_EXCEPTION = "El nombre es distinto";
    public static final String CURSO_EXCEPTION = "El curso es distinto";
    public static final String MATRICULAS_EXCEPTION = "La lista de matriculas no existe";
    public static final String NO_EXISTE_EXCEPTION = "No existe la asignatura";
    @Autowired
    IMatriculaRepository matriculaRepository;

    @Autowired
    IAsignaturaRepository asignaturaRepository;

    @Autowired
    IAlumnoRepository alumnoRepository;
    @Override
    public List<Matricula> findAll() {
        return matriculaRepository.findAll();
    }

    @Override
    public Matricula findById(Integer id) {
        return matriculaRepository.findById(id).orElse(null);
    }

    @Override
    @Transactional
    public Matricula save(Matricula obj) {
        if(obj.getAlumno() == null){
            return null;
        }

        Alumno alumno = alumnoRepository.findById(obj.getAlumno().getDni()).orElse(null);

        if(alumno == null){
            return null;
        }
        
        List<Asignatura> list = new ArrayList<>();

        if(obj.getAsignaturas()!= null && !obj.getAsignaturas().isEmpty()){
            obj.getAsignaturas().forEach(
                asignatura -> {
                    Asignatura aux = asignaturaRepository.findById(asignatura.getId()).orElse(null);
                    if(aux == null){
                        throw new RuntimeException(NO_EXISTE_EXCEPTION);
                    }

                    if(asignatura.getId() != aux.getId()){
                        throw new RuntimeException(ID_EXCEPTION);
                    }


                    if(!asignatura.getNombre().equals(aux.getNombre())){
                        throw new RuntimeException(NOMBRE_EXCEPTION);
                    }


                    if(!asignatura.getCurso().equals(aux.getCurso())){
                        throw new RuntimeException(CURSO_EXCEPTION);
                    }


                    //if(!asignatura.getMatriculas().equals(aux.getMatriculas())){
                    //    throw new RuntimeException(MATRICULAS_EXCEPTION);
                    //}

                    list.add(aux);
                    aux.getMatriculas().add(obj);
                }
            );

            obj.setAsignaturas(list);
        }

        Matricula result = matriculaRepository.save(obj);

        if(!obj.getAsignaturas().isEmpty()){
            matriculaRepository.deleteRelatedAsignaturaRelationsById(obj.getId());
            for (int i=0; i< obj.getAsignaturas().size(); i++){
                matriculaRepository.insertAsignaturasMatriculas(obj.getId(), obj.getAsignaturas().get(i).getId());
            }
        }

        return result;
    }

    @Override
    @Transactional
    public boolean delete(Integer id) {
        try {
            matriculaRepository.deleteRelatedAsignaturaRelationsById(id);
            int quantity = matriculaRepository.deleteMatriculaById(id);
            return quantity > 0;
        } catch (RuntimeException e){
            return false;
        }
    }

    @Override
    @Transactional
    public boolean update(Matricula obj) {
        if(obj!=null) {

            Alumno alumno = alumnoRepository.findById(obj.getAlumno().getDni()).orElse(null);

            if(alumno == null){
                throw new RuntimeException();
            }

            List<Asignatura> list = new ArrayList<>();

            if(obj.getAsignaturas()!= null && !obj.getAsignaturas().isEmpty()){
                obj.getAsignaturas().forEach(
                        asignatura -> {
                            Asignatura aux = asignaturaRepository.findById(asignatura.getId()).orElse(null);
                            if(aux == null){
                                throw new RuntimeException(NO_EXISTE_EXCEPTION);
                            }

                            if(asignatura.getId() != aux.getId()){
                                throw new RuntimeException(ID_EXCEPTION);
                            }


                            if(!asignatura.getNombre().equals(aux.getNombre())){
                                throw new RuntimeException(NOMBRE_EXCEPTION);
                            }


                            if(!asignatura.getCurso().equals(aux.getCurso())){
                                throw new RuntimeException(CURSO_EXCEPTION);
                            }


                            // if(!asignatura.getMatriculas().equals(aux.getMatriculas())){
                            //    throw new RuntimeException(MATRICULAS_EXCEPTION);
                            //}

                            list.add(aux);
                            aux.getMatriculas().add(obj);
                        }
                );

                obj.setAsignaturas(list);
            }

            Matricula dbItem = matriculaRepository.findById(obj.getId()).orElse(null);
            if(dbItem != null){
                dbItem.setAlumno(obj.getAlumno());
                dbItem.setYear(obj.getYear());
                dbItem.setAsignaturas(obj.getAsignaturas());

                //matriculaRepository.deleteRelatedAsignaturaRelationsById((obj.getId()));

                if(!obj.getAsignaturas().isEmpty()){
                    matriculaRepository.deleteRelatedAsignaturaRelationsById(obj.getId());
                    for (int i=0; i< obj.getAsignaturas().size(); i++){
                        matriculaRepository.insertAsignaturasMatriculas(obj.getId(), obj.getAsignaturas().get(i).getId());
                    }
                }



                return true;
            }
        }
        return false;
    }
}
