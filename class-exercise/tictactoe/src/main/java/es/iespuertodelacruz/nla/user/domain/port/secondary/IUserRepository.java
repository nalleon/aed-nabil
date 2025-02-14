package es.iespuertodelacruz.nla.user.domain.port.secondary;

import es.iespuertodelacruz.nla.user.domain.User;

import java.util.List;

public interface IUserRepository {
    User save(User user);
    List<User> findAll();
    User findById(Integer id);
    User findByUserame(String username);
    User findByEmail(String email);
    boolean delete(Integer id);
    boolean update(User user);
}
