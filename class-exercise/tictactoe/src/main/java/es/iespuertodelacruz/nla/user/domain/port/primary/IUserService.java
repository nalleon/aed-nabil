package es.iespuertodelacruz.nla.user.domain.port.primary;

import es.iespuertodelacruz.nla.user.domain.User;

import java.util.List;

public interface IUserService {
    User add(String name, String email, String password);
    User findById(Integer id);
    List<User> findAll();
    boolean delete(Integer id);
    boolean update(String name, String email, String password);

}
