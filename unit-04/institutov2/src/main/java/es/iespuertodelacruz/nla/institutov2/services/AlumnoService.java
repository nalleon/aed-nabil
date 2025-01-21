package es.iespuertodelacruz.nla.institutov2.services;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.repository.IAlumnoRepository;

@Service
public class AlumnoService implements IServiceGeneric<Alumno, String>{

	@Autowired IAlumnoRepository repository;
	@Override
	public List<Alumno> findAll() {
		return repository.findAll();
	}

	@Override
	public Alumno findById(String id) {
		return repository.findById(id).orElse(null);
	}

	@Override
	@Transactional
	public Alumno save(Alumno obj) {
		return repository.save(obj);
	}

	@Override
	@Transactional
	public boolean delete(String id) {
		int quantity = repository.deleteAlumnoByDNI(id);
		return quantity > 0;
	}

	@Override
	@Transactional
	public boolean update(Alumno obj) {
		if(obj!=null &&  obj.getDni() != null) {
			Alumno dbItem = repository.findById(obj.getDni()).orElse(null);
			if(dbItem != null){
				try {
					dbItem.setNombre(obj.getNombre());
					dbItem.setApellidos(obj.getApellidos());
					dbItem.setFechanacimiento(obj.getFechanacimiento());
					dbItem.setMatriculas(obj.getMatriculas());
					return true;
				} catch (RuntimeException e){
					throw new RuntimeException("Invalid data");
				}
			}
		}
		return false;
	}

}
