package es.iespuertodelacruz.nla.game.infrastructure.adapters.secondary.entities;

import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities.IUserEntityMapper;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;
import org.mapstruct.Named;
import org.mapstruct.factory.Mappers;

import java.util.List;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@Mapper(uses = {IUserEntityMapper.class})
public interface IGameEntityMapper {
    IGameEntityMapper INSTANCE = Mappers.getMapper(IGameEntityMapper.class);

    @Mapping(source = "board", target = "board", qualifiedByName = "mapBoardToDomain")
    Game toDomain(GameEntity entity);
    @Mapping(source = "board", target = "board", qualifiedByName = "mapBoardToEntity")
    GameEntity toEntity(Game domain);
    @Mapping(source = "board", target = "board", qualifiedByName = "mapBoardToDomain")
    List<Game> toDomainList(List<GameEntity> entities);
    @Mapping(source = "board", target = "board", qualifiedByName = "mapBoardToEntity")
    List<GameEntity> toEntityList(List<Game> domains);

    @Named("mapBoardToDomain")
    default char[][] mapBoardToDomain(String board) {
        char[][] result = {{' ', ' ', ' '}, {' ', ' ', ' '}, {' ', ' ', ' '}};

        if (board == null) {
            return result;
        }

        char[] splitBoard = board.toCharArray();

        int counter = 0;

        for (int i=0; i<3; i++){
            for (int j=0; j<3; j++){
                result[i][j] = splitBoard[counter];
                counter++;
            }
        }
        return result;
    }

    @Named("mapBoardToEntity")
    default String mapBoardToEntity(char[][] board) {

        StringBuilder result = new StringBuilder();

        if(board == null){
            return result.toString();
        }
        for (int i=0; i<3; i++){
            for (int j=0; j<3; j++){
                    result.append(board[i][j]);
            }
        }
        return result.toString();
    }
}