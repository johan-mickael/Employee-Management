INSERT INTO
    `administrateur` (
        `id_administrateur`,
        `nom_administrateur`,
        `mot_de_passe`
    )
VALUES
    (NULL, 'johan', SHA1('johan'));

INSERT INTO
    `categorie` (
        `id_categorie`,
        `nom_categorie`,
        `heure`,
        `salaire`,
        `indemnite`
    )
VALUES
    (NULL, 'normal', '42', '102500', '28'),
    (NULL, 'gardien', '56', '105500', '28'),
    (NULL, 'chauffeur', '48', '103200', '28');

INSERT INTO
    `employee` (
        `id_employee`,
        `nom_employee`,
        `matricule`,
        `dt_naissance`,
        `dt_embauche`,
        `dt_fin_contrat`,
        `categorie_emp`,
        `mot_de_passe`
    )
VALUES
    (
        NULL,
        'RAKOTONIAINA Johan',
        'EMP0001',
        '1999-10-05',
        '2021-07-04',
        '2025-07-04',
        '1',
        'johan'
    ),
(
        NULL,
        'test 002',
        'EMP0002',
        '1980-07-04',
        '2021-07-01',
        '2022-07-01',
        '4',
        'test'
    ),
    (
        NULL,
        'test 002',
        'EMP0003',
        '1980-07-04',
        '2021-07-01',
        '2023-07-01',
        '2',
        'test'
    ),
    (
        NULL,
        'test 003',
        'EMP0004',
        '1980-07-04',
        '2021-07-01',
        '2023-07-01',
        '2',
        'test'
    );

INSERT INTO
    `pointage_mere` (
        `id_pointage_mere`,
        `id_employee`,
        `dt_enregistrement`
    )
VALUES
    (NULL, '1', '2021-07-05');

INSERT INTO
    pointage_fille
values
    (null, 19, 1, 10, 2, 0),
    (null, 19, 2, 10, 2, 0),
    (null, 19, 3, 5, 2, 0),
    (null, 19, 4, 5, 2, 0),
    (null, 19, 5, 10, 0, 8),
    (null, 19, 6, 0, 1, 8),
    (null, 19, 7, 10, 2, 0);

insert into
    indemnite
values
(null, 30);

insert into
    indemnite
values
(null, 40);

INSERT INTO
    `h_supplementaire` (
        `id_h_supplementaire`,
        `designation`,
        `h_max`,
        `pourcentage`
    )
VALUES
    (NULL, 'HS30', '8', '130'),
    (NULL, 'HS50', '20', '150');

INSERT INTO
    `h_majoree` (`id_h_majoree`, `designation`, `pourcentage`)
VALUES
    (NULL, 'HM30', '130'),
    (NULL, 'HM40', '140'),
    (NULL, 'HM50', '150'),
    (NULL, 'HJ', '100'),
    (NULL, 'HF', '100');

INSERT INTO
    `impot` (`id`, `pourcentage`)
VALUES
    (NULL, '20');