package es.iespuertodelacruz.nla.institutov2.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;

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
}
