package es.iespuertodelacruz.nla.game.infrastructure.adapters.secondary.entities;

import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.game.domain.port.secondary.IGameRepository;
import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities.IUserEntityMapper;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities.UserEntity;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.Arrays;
import java.util.List;
import java.util.UUID;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@Service
public class GameEntityService implements IGameRepository {


    public static final String BOARD = "_________";
    @Autowired
    private IGameEntityRepository repository;

    @Override
    @Transactional
    public Game save(Game game) {
        if(game == null){
            return null;
        }

        try {
            GameEntity entity = IGameEntityMapper.INSTANCE.toEntity(game);
            entity.setBoard(null);
            entity.setPlayer1(IUserEntityMapper.INSTANCE.toEntity(game.getPlayer1()));
            entity.setPlayer2(null);
            entity.setFinished(false);
            GameEntity savedEntity = repository.save(entity);
            return IGameEntityMapper.INSTANCE.toDomain(savedEntity);
        } catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }
    }

    @Override
    public List<Game> findAll() {
        List<GameEntity> listEntities = repository.findAll();
        return IGameEntityMapper.INSTANCE.toDomainList(listEntities);
    }

    @Override
    public Game findById(Integer id) {
        GameEntity entityFound = repository.findById(id).orElse(null);

        if (entityFound != null){
            System.out.println(IGameEntityMapper.INSTANCE.toDomain(entityFound));
            return IGameEntityMapper.INSTANCE.toDomain(entityFound);
        }
        return null;
    }


    @Override
    @Transactional
    public boolean delete(Integer id) {
        int quantity = repository.deleteGameById(id);
        return quantity > 0;
    }

    @Override
    @Transactional
    public Game update(Game game) {
        if(game == null ){
            return null;
        }

        GameEntity dbItem = repository.findById(game.getId()).orElse(null);

        if(dbItem == null){
            return null;
        }

        try {
            String result = mapCharArr(game.getBoard());
            dbItem.setBoard(result);
            dbItem.setPlayer2(IUserEntityMapper.INSTANCE.toEntity(game.getPlayer2()));
            dbItem.setFinished(game.isFinished());
            return IGameEntityMapper.INSTANCE.toDomain(dbItem);
        }  catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }

    }

    /**
     * Function to map the board from a char matric to a string
     * @param board to map
     * @return string of the result
     */
    public String mapCharArr (char [][] board){
        String result = "";

        for (int i=0; i<3; i++){
            for (int j=0; j<3; j++){
                if(i==2 && j==2){
                    result += board[i][j];
                } else {
                    result += board[i][j] + ",";
                }
            }
        }

        return result;
    }

    @Override
    public Game findOpenGame() {
        GameEntity found = repository.findOpenGame().orElse(null);
        if (found == null) {
            return null;
        }

        System.out.println("FOUND: " + found);

        return IGameEntityMapper.INSTANCE.toDomain(found);
    }

    @Override
    @Transactional
    public Game joinGame(Game game) {
        if(game == null){
            return null;
        }

        GameEntity dbItem = repository.findById(game.getId()).orElse(null);

        if(dbItem == null){
            return null;
        }

        try {
            dbItem.setPlayer2(IUserEntityMapper.INSTANCE.toEntity(game.getPlayer2()));
            dbItem.setBoard(BOARD);
            return IGameEntityMapper.INSTANCE.toDomain(dbItem);
        }  catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }

    }

    @Override
    public Game play(Game game, User user, int posX, int posY, char symbol) {
        if(game == null || user == null){
            return null;
        }

        char[][] auxBoard = game.getBoard();

        auxBoard[posX][posY] = symbol;

        game.setBoard(auxBoard);

        GameEntity entity = IGameEntityMapper.INSTANCE.toEntity(game);

        if(entity == null){
            return null;
        }

        try {
            GameEntity savedEntity = repository.save(entity);
            return IGameEntityMapper.INSTANCE.toDomain(savedEntity);
        }  catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }

    }
}
