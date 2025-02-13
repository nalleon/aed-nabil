package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary;

import es.iespuertodelacruz.nla.user.domain.User;
import org.mapstruct.Mapper;
import org.mapstruct.factory.Mappers;

import java.util.List;

@Mapper
public interface IUserEntityMapper {
    IUserEntityMapper INSTANCE = Mappers.getMapper(IUserEntityMapper.class);

    User toDomain(UserEntity entity);
    UserEntity toEntity(User domain);
    List<User> toDomainList(List<UserEntity> entities);
    List<UserEntity> toEntityList(List<User> domains);


}