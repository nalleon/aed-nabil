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
	public Alumno save(Alumno t) {
		return repository.save(t);
	
	}

	@Override
	@Transactional
	public boolean delete(String id) {
		int quantity = repository.deleteAlumnoByDNI(id);
		return quantity > 0;
	}

	@Override
	@Transactional
	public boolean update(Alumno t) {
		if(t!=null &&  t.getDni() != null) {
			Alumno alumno = repository.findById(t.getDni()).orElse(null);
			alumno.setNombre(t.getNombre());
			alumno.setApellidos(t.getApellidos());
			alumno.setFechanacimiento(t.getFechanacimiento());
			alumno.setMatriculas(t.getMatriculas());
		}
		
		// RunTimeException para parar 
		
		return false;
	}

}
