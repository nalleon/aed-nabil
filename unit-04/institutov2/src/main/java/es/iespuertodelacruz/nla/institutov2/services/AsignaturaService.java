package es.iespuertodelacruz.nla.institutov2.services;

import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.entities.Matricula;
import es.iespuertodelacruz.nla.institutov2.repository.IAlumnoRepository;
import es.iespuertodelacruz.nla.institutov2.repository.IAsignaturaRepository;
import es.iespuertodelacruz.nla.institutov2.repository.IMatriculaRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.ArrayList;
import java.util.List;
@Service
public class AsignaturaService implements IServiceGeneric<Asignatura, Integer> {
    public static final String NO_EXISTE_EXCEPTION = "No existe la matricula";
    public static final String ID_EXCEPTION = "El id es distinto";
    public static final String ALUMNO_EXCEPTION = "El alumno es distinto";
    public static final String CURSO_EXCEPTION = "El curso es distinto";
    public static final String ASIGNATURAS_EXCEPTION = "La lista de asignaturas es disntinta";
    @Autowired
    IMatriculaRepository matriculaRepository;

    @Autowired
    IAsignaturaRepository asignaturaRepository;

    @Autowired
    IAlumnoRepository alumnoRepository;
    @Override
    public List<Asignatura> findAll() {
        return asignaturaRepository.findAll();
    }

    @Override
    public Asignatura findById(Integer id) {
        return asignaturaRepository.findById(id).orElse(null);
    }

    @Override
    @Transactional
    public Asignatura save(Asignatura obj) {
        if(obj == null){
            return null;
        }


        List<Matricula> list = new ArrayList<>();
        if(obj.getMatriculas() != null && !obj.getMatriculas().isEmpty()){
            obj.getMatriculas().forEach(
                    matricula -> {
                        Matricula aux = matriculaRepository.findById(matricula.getId()).orElse(null);

                        if(aux == null){
                            throw new RuntimeException(NO_EXISTE_EXCEPTION);
                        }

                        if(matricula.getId() != aux.getId()){
                            throw new RuntimeException(ID_EXCEPTION);
                        }


                        if(!matricula.getAlumno().equals(aux.getAlumno())){
                            throw new RuntimeException(ALUMNO_EXCEPTION);
                        }


                        if(matricula.getYear() == (aux.getYear())){
                            throw new RuntimeException(CURSO_EXCEPTION);
                        }


                        if(!matricula.getAsignaturas().equals(aux.getAsignaturas())){
                            throw new RuntimeException(ASIGNATURAS_EXCEPTION);
                        }

                        list.add(aux);
                        aux.getAsignaturas().add(obj);
                    }
            );
            obj.setMatriculas(list);
        }

        return asignaturaRepository.save(obj);
    }

    @Override
    @Transactional
    public boolean delete(Integer id) {
        try {
            asignaturaRepository.deleteRelatedMatriculaRelationsById(id);
            int quantity = asignaturaRepository.deleteAsignaturaById(id);
            return quantity > 0;
        } catch (RuntimeException e){
            throw new RuntimeException();
        }
    }

    @Override
    @Transactional
    public boolean update(Asignatura obj) {
        if(obj!=null) {

        }
            List<Matricula> list = new ArrayList<>();
            if(obj.getMatriculas() != null && !obj.getMatriculas().isEmpty()){
                obj.getMatriculas().forEach(
                        matricula -> {
                            Matricula aux = matriculaRepository.findById(matricula.getId()).orElse(null);

                            if(aux == null){
                                throw new RuntimeException(NO_EXISTE_EXCEPTION);
                            }

                            if(matricula.getId() != aux.getId()){
                                throw new RuntimeException(ID_EXCEPTION);
                            }


                            if(!matricula.getAlumno().equals(aux.getAlumno())){
                                throw new RuntimeException(ALUMNO_EXCEPTION);
                            }


                            if(matricula.getYear() == (aux.getYear())){
                                throw new RuntimeException(CURSO_EXCEPTION);
                            }


                            if(!matricula.getAsignaturas().equals(aux.getAsignaturas())){
                                throw new RuntimeException(ASIGNATURAS_EXCEPTION);
                            }

                            list.add(aux);
                            aux.getAsignaturas().add(obj);
                        }
                );
                obj.setMatriculas(list);

            Asignatura dbItem = asignaturaRepository.findById(obj.getId()).orElse(null);
            if(dbItem != null){
                dbItem.setCurso(obj.getCurso());
                dbItem.setNombre(obj.getNombre());
                dbItem.setMatriculas(obj.getMatriculas());
                return true;
            }
        }
        return false;
    }
}
