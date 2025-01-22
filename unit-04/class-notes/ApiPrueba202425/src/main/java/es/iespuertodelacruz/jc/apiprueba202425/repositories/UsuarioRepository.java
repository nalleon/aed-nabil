package es.iespuertodelacruz.jc.apiprueba202425.repositories;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.jc.apiprueba202425.entities.Usuario;


@Repository
public interface UsuarioRepository extends JpaRepository<Usuario, Integer> {
	Optional<Usuario> findByNombre(String nombre);
}