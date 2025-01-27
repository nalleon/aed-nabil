package es.iespuertodelacruz.nla.institutov2.repository;

import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface IUsuarioRepository extends JpaRepository<Usuario, String> {


    @Modifying
    @Query(
            value="DELETE FROM usuarios AS u WHERE u.dni=:dni",
            nativeQuery=true
    )
    int deleteUsuarioByDNI(@Param("dni") String dni);


    @Query(
            value="SELECT * FROM usuarios WHERE nombre LIKE %:nombre%",
            nativeQuery=true
    )
    Optional<Usuario> findUsuarioByNombre(@Param("nombre") String nombre);


    @Query(
            value="SELECT * FROM usuarios WHERE correo LIKE %:correo%",
            nativeQuery=true
    )
    Optional<Usuario> findUsuarioByCorreo(@Param("correo") String correo);
}
