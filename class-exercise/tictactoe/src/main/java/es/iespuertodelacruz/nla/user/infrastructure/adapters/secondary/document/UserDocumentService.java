package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.document;

import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.domain.port.secondary.IUserRepository;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities.IUserEntityRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@Service
public class UserDocumentService implements IUserRepository {
    @Autowired
    private IUserEntityRepository repository;

    @Override
    public User save(User user) {
//        UserDocument
        return null;
    }

    @Override
    public List<User> findAll() {
        return null;
    }

    @Override
    public User findById(Integer id) {
        return null;
    }

    @Override
    public User findByUserame(String username) {
        return null;
    }

    @Override
    public User findByEmail(String email) {
        return null;
    }

    @Override
    public boolean delete(Integer id) {
        return false;
    }

    @Override
    public boolean update(User user) {
        return false;
    }
}
