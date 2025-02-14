package es.iespuertodelacruz.nla.game.infrastructure.adapters.secondary.entities;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@Repository
public interface IGameEntityRepository extends JpaRepository<GameEntity, Integer> {

    @Modifying
    @Query(
            value="DELETE FROM partudas AS p WHERE p.id=:id",
            nativeQuery=true
    )
    int deleteGameById(@Param("id") Integer id);


}
