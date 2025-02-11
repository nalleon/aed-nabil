package es.iespuertodelacruz.vsa.product.infrastructure.adapters.secondary;

import es.iespuertodelacruz.vsa.product.domain.Product;
import org.mapstruct.Mapper;
import org.mapstruct.factory.Mappers;

import java.util.List;

@Mapper
public interface IProductDocumentMapper {
    IProductDocumentMapper INSTANCE = Mappers.getMapper(IProductDocumentMapper.class);
    Product toDomain(ProductDocument document);
    ProductDocument toDocument(Product domain);
    List<Product> toDomainList(List<ProductDocument> documents);
    List<ProductDocument> toDocumentList(List<Product> domains);


}