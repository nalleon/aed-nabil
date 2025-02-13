package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary;

import es.iespuertodelacruz.nla.user.domain.User;
import org.mapstruct.Mapper;
import org.mapstruct.factory.Mappers;

import java.util.List;

@Mapper
public interface IUserDocumentMapper {
    IUserDocumentMapper INSTANCE = Mappers.getMapper(IUserDocumentMapper.class);
    User toDomain(UserDocument document);
    UserDocument toDocument(User domain);
    List<User> toDomainList(List<UserDocument> documents);
    List<UserDocument> toDocumentList(List<User> domains);
}