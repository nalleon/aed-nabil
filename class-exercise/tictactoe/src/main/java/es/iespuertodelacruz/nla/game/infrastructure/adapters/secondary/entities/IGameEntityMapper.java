package es.iespuertodelacruz.nla.game.infrastructure.adapters.secondary.entities;

import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities.IUserEntityMapper;
import org.mapstruct.*;
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
        char[][] result = {{'_', '_', '_'}, {'_', '_', '_'}, {'_', '_', '_'}};

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

    @AfterMapping
    default void setTurn(@MappingTarget Game game, GameEntity entity) {
        game.setCurrentTurn(determineTurn(game));
    }

    private User determineTurn(Game game) {
        if (game == null || game.getBoard() == null) {
            return null;
        }
        int counterPlayer1 = 0;
        int counterPlayer2 = 0;

        for (char[] row : game.getBoard()) {
            for (char cell : row) {
                if (cell == 'x') {
                    counterPlayer1++;
                }  else if (cell == 'o'){
                    counterPlayer2++;
                }
            }
        }

        return (counterPlayer1 <= counterPlayer2) ? game.getPlayer1() : game.getPlayer2();
    }
}