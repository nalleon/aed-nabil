package es.iespuertodelacruz.nla.persona.infrastructure.adapters.secondary;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface IPersonaEntityRepository extends JpaRepository<PersonaEntity, Integer> {
}
