package es.iespuertodelacruz.nla.institutov2.services;

import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.entities.Matricula;
import es.iespuertodelacruz.nla.institutov2.repository.IAlumnoRepository;
import es.iespuertodelacruz.nla.institutov2.repository.IAsignaturaRepository;
import es.iespuertodelacruz.nla.institutov2.repository.IMatriculaRepository;
import org.springframework.beans.factory.annotation.Autowired;

import java.util.ArrayList;
import java.util.List;

public class AsignaturaService implements IServiceGeneric<Asignatura, Integer> {
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
                            throw new RuntimeException("No existe la matricula");
                        }

                        if(matricula.getId() != aux.getId()){
                            throw new RuntimeException("El id es distinto");
                        }


                        if(!matricula.getAlumno().equals(aux.getAlumno())){
                            throw new RuntimeException("El alumno es distinto");
                        }


                        if(matricula.getYear() == (aux.getYear())){
                            throw new RuntimeException("El curso es distinto");
                        }


                        if(!matricula.getAsignaturas().equals(aux.getAsignaturas())){
                            throw new RuntimeException("La lista de asignaturas es disntinta");
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
    public boolean update(Asignatura obj) {
        if(obj!=null) {
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
