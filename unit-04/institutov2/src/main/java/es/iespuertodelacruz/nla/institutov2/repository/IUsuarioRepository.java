package es.iespuertodelacruz.nla.institutov2.repository;

import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import org.springframework.data.jpa.repository.JpaRepository;

public interface IUsuarioRepository extends JpaRepository<Usuario, String> {


}
