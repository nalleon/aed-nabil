package es.iespuertodelacruz.nla.institutov2.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.nla.institutov2.entities.Matricula;

@Repository
public interface IMatriculaRepository extends JpaRepository<Matricula, Integer>{
    @Modifying
    @Query(
            value="DELETE FROM asignatura_matricula AS am WHERE am.idmatricula=:idmatricula",
            nativeQuery=true
    )
    int deleteRelatedAsignaturaRelationsById(@Param("idmatricula") Integer idmatricula);
    @Modifying
    @Query(
            value="DELETE FROM matricula AS m WHERE m.id=:id",
            nativeQuery=true
    )
    int deleteMatriculaById(@Param("id") Integer id);
}
