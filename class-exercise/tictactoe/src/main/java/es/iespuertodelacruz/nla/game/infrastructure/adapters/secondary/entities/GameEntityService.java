package es.iespuertodelacruz.nla.game.infrastructure.adapters.secondary.entities;

import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.game.domain.port.secondary.IGameRepository;
import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities.IUserEntityMapper;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities.UserEntity;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;
import java.util.UUID;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@Service
public class GameEntityService implements IGameRepository {

    public static final char[][] NEW_BOARD = new char[][]{{' ', ' ', ' '}, {' ', ' ', ' '}, {' ', ' ', ' '}};
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
            return IGameEntityMapper.INSTANCE.toDomain(entityFound);
        }
        return  null;
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
            dbItem.setBoard(game.getBoard());
            dbItem.setPlayer2(IUserEntityMapper.INSTANCE.toEntity(game.getPlayer2()));
            dbItem.setFinished(game.isFinished());
            return IGameEntityMapper.INSTANCE.toDomain(dbItem);
        }  catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }

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
            return IGameEntityMapper.INSTANCE.toDomain(dbItem);
        }  catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }

    }
}
