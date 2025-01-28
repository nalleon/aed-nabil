package es.iespuertodelacruz.nla.institutov2.controller.interfaces;

import org.springframework.http.ResponseEntity;

import java.util.List;

public interface IControllerV2<T, E> {
    public ResponseEntity<T> getById(E id);
    public ResponseEntity<List<T>> getAll();

}
