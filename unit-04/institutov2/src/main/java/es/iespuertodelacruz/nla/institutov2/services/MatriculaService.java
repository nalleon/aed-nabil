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
    public Matricula save(Matricula matricula) {
        if(matricula.getAlumno() == null){
            return null;
        }

        Alumno alumno = alumnoRepository.findById(matricula.getAlumno().getDni()).orElse(null);

        if(alumno == null){
            return null;
        }


        List<Asignatura> list = new ArrayList<>();

        if(matricula.getAsignaturas()!= null && !matricula.getAsignaturas().isEmpty()){
            matricula.getAsignaturas().forEach(
                asignatura -> {
                    Asignatura aux = asignaturaRepository.findById(asignatura.getId()).orElse(null);
                    if(aux == null){
                        throw new RuntimeException("No existe la asignatura");
                    }

                    if(asignatura.getId() != aux.getId()){
                        throw new RuntimeException("El id es distinto");
                    }


                    if(!asignatura.getNombre().equals(aux.getNombre())){
                        throw new RuntimeException("El nombre es distinto");
                    }


                    if(!asignatura.getCurso().equals(aux.getCurso())){
                        throw new RuntimeException("El curso es distinto");
                    }


                    if(!asignatura.getMatriculas().equals(aux.getMatriculas())){
                        throw new RuntimeException("La lista de matriculas");
                    }

                    list.add(aux);
                    aux.getMatriculas().add(matricula);
                }
            );

            matricula.setAsignaturas(list);
        }
        return matriculaRepository.save(matricula);
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
    public boolean update(Matricula matricula) {
        return false;
    }
}
