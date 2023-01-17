<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
#[ORM\Table('departments')]
class Department
{
    #[ORM\Id]
    #[ORM\Column(name: '`dept_no`', type: 'string')]
    private ?string $id = null;

    #[ORM\Column(length: 40)]
    private ?string $dept_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $roi_url = null;

    #[ORM\JoinTable(name: 'dept_manager')]
    #[ORM\JoinColumn(name: 'dept_no', referencedColumnName: 'dept_no')]
    #[ORM\InverseJoinColumn(name: 'emp_no', referencedColumnName: 'emp_no')]
    #[ORM\ManyToMany(targetEntity: Employee::class, inversedBy: 'departments')]
    private Collection $managers;

    #[ORM\JoinTable(name: 'dept_title')]
    #[ORM\JoinColumn(name: 'dept_no', referencedColumnName: 'dept_no')]
    #[ORM\InverseJoinColumn(name: 'title_no', referencedColumnName: 'title_no')]
    #[ORM\ManyToMany(targetEntity: Title::class, mappedBy: 'departments')]
    private Collection $titles;

    public function __construct()
    {
        $this->managers = new ArrayCollection();
        $this->titles = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDeptName(): ?string
    {
        return $this->dept_name;
    }

    public function setDeptName(string $dept_name): self
    {
        $this->dept_name = $dept_name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getRoiUrl(): ?string
    {
        return $this->roi_url;
    }

    public function setRoiUrl(string $roi_url): self
    {
        $this->roi_url = $roi_url;

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getManagers(): Collection
    {
        return $this->managers;
    }

    public function addManager(Employee $manager): self
    {
        if (!$this->managers->contains($manager)) {
            $this->managers->add($manager);
        }

        return $this;
    }

    public function removeManager(Employee $manager): self
    {
        $this->managers->removeElement($manager);

        return $this;
    }

    /**
     * @return Collection<int, DeptTitle>
     */
    public function getTitles(): Collection
    {
        return $this->titles;
    }

    public function addTitle(Title $title): self
    {
        if (!$this->titles->contains($title)) {
            $this->titles->add($title);
            $title->addDepartment($this);
        }

        return $this;
    }

    public function removeTitle(Title $title): self
    {
        if ($this->deptTitles->removeElement($deptTitle)) {
            $title->removeDepartment($this);
        }

        return $this;
    }
    public function __toString()
    {
        return "{$this->getDeptName()}";
    }
}
