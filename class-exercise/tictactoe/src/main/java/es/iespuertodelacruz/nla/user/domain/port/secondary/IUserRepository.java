package es.iespuertodelacruz.nla.user.domain.port.secondary;

import es.iespuertodelacruz.nla.user.domain.User;

import java.util.List;

public interface IUserRepository {
    User save(User user);
    List<User> findAll();
    User findById(Integer id);
    boolean delete(Integer id);
    boolean update(User user);
}
