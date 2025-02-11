package es.iespuertodelacruz.vsa.product.infrastructure.adapters.secondary;

import es.iespuertodelacruz.vsa.product.domain.Product;
import org.mapstruct.Mapper;
import org.mapstruct.factory.Mappers;

import java.util.List;

@Mapper
public interface IProductEntityMapper {
    IProductEntityMapper INSTANCE = Mappers.getMapper(IProductEntityMapper.class);

    Product toDomain(ProductEntity entity);
    ProductEntity toEntity(Product domain);
    List<Product> toDomainList(List<ProductEntity> entities);
    List<ProductEntity> toEntityList(List<Product> domains);


}