package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface IUserEntityRepository extends JpaRepository<UserEntity, Integer> {
}
