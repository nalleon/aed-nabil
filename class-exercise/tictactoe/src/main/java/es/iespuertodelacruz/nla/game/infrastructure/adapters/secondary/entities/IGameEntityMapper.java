package es.iespuertodelacruz.nla.game.infrastructure.adapters.secondary.entities;

import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities.IUserEntityMapper;
import org.mapstruct.Mapper;
import org.mapstruct.factory.Mappers;

import java.util.List;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@Mapper(uses = {IUserEntityMapper.class})
public interface IGameEntityMapper {
    IGameEntityMapper INSTANCE = Mappers.getMapper(IGameEntityMapper.class);
    Game toDomain(GameEntity entity);
    GameEntity toEntity(Game domain);
    List<Game> toDomainList(List<GameEntity> entities);
    List<GameEntity> toEntityList(List<Game> domains);


}