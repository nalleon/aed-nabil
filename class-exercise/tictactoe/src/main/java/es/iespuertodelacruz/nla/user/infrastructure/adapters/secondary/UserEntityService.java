package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary;

import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.domain.port.secondary.IUserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@Service
public class UserEntityService implements IUserRepository {

    @Autowired
    private IUserEntityRepository repository;

    @Override
    public User save(User user) {
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
}
