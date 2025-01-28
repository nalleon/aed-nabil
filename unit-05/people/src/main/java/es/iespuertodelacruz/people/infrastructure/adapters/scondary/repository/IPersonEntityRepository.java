package es.iespuertodelacruz.people.infrastructure.adapters.scondary.repository;

import es.iespuertodelacruz.people.infrastructure.adapters.scondary.entities.PersonaEntity;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;


@Repository
public interface IPersonEntityRepository extends JpaRepository<PersonaEntity, Integer> {

}
