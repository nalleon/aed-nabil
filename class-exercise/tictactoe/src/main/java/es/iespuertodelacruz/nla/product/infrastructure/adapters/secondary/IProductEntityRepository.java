package es.iespuertodelacruz.nla.product.infrastructure.adapters.secondary;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface IProductEntityRepository extends JpaRepository<ProductEntity, Integer> {
}
