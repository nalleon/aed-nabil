package es.iespuertodelacruz.nla.institutov2.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;

import java.util.Optional;

@Repository
public interface IAsignaturaRepository extends JpaRepository<Asignatura, Integer>{
    @Modifying
    @Query(
            value="DELETE FROM asignaturas_matriculas AS am WHERE am.idasignatura=:idasignatura",
            nativeQuery=true
    )
    int deleteRelatedMatriculaRelationsById(@Param("idasignatura") Integer idasignatura);
    @Modifying
    @Query(
            value="DELETE FROM asignaturas AS a WHERE a.id=:id",
            nativeQuery=true
    )
    int deleteAsignaturaById(@Param("id") Integer id);

    @Query(
            value="SELECT * FROM asignaturas AS a WHERE a.nombre LIKE %:nombre% AND a.curso LIKE %:curso%",
            nativeQuery=true
    )
    //LIKE %:
    Optional<Asignatura> findByNombreCurso(@Param("nombre") String nombre, @Param("curso") String curso);
}
